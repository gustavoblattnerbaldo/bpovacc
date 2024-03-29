/*!
 * Parsleyjs
 * Guillaume Potier - <guillaume@wisembly.com>
 * Version 2.1.2 - built Tue Jun 16 2015 10:46:42
 * MIT Licensed
 *
 */
!(function (a) {
  'function' == typeof define && define.amd
    ? define(['jquery'], a)
    : 'object' == typeof exports
    ? (module.exports = a(require('jquery')))
    : a(jQuery);
})(function (a) {
  function b(a, b) {
    return (
      a.parsleyAdaptedCallback ||
        (a.parsleyAdaptedCallback = function () {
          var c = Array.prototype.slice.call(arguments, 0);
          c.unshift(this), a.apply(b || q, c);
        }),
      a.parsleyAdaptedCallback
    );
  }
  function c(a) {
    return 0 === a.lastIndexOf(s, 0) ? a.substr(s.length) : a;
  }
  'undefined' == typeof a &&
    'undefined' != typeof window.jQuery &&
    (a = window.jQuery);
  var d = 1,
    e = {},
    f = {
      attr: function (a, b, c) {
        var d,
          e,
          f = new RegExp('^' + b, 'i');
        if ('undefined' == typeof c) c = {};
        else for (var g in c) c.hasOwnProperty(g) && delete c[g];
        if ('undefined' == typeof a || 'undefined' == typeof a[0]) return c;
        e = a[0].attributes;
        for (var g = e.length; g--; )
          (d = e[g]),
            d &&
              d.specified &&
              f.test(d.name) &&
              (c[this.camelize(d.name.slice(b.length))] = this.deserializeValue(
                d.value
              ));
        return c;
      },
      checkAttr: function (a, b, c) {
        return a.is('[' + b + c + ']');
      },
      setAttr: function (a, b, c, d) {
        a[0].setAttribute(this.dasherize(b + c), String(d));
      },
      generateID: function () {
        return '' + d++;
      },
      deserializeValue: function (b) {
        var c;
        try {
          return b
            ? 'true' == b ||
                ('false' == b
                  ? !1
                  : 'null' == b
                  ? null
                  : isNaN((c = Number(b)))
                  ? /^[\[\{]/.test(b)
                    ? a.parseJSON(b)
                    : b
                  : c)
            : b;
        } catch (d) {
          return b;
        }
      },
      camelize: function (a) {
        return a.replace(/-+(.)?/g, function (a, b) {
          return b ? b.toUpperCase() : '';
        });
      },
      dasherize: function (a) {
        return a
          .replace(/::/g, '/')
          .replace(/([A-Z]+)([A-Z][a-z])/g, '$1_$2')
          .replace(/([a-z\d])([A-Z])/g, '$1_$2')
          .replace(/_/g, '-')
          .toLowerCase();
      },
      warn: function () {
        window.console &&
          window.console.warn &&
          window.console.warn.apply(window.console, arguments);
      },
      warnOnce: function (a) {
        e[a] || ((e[a] = !0), this.warn.apply(this, arguments));
      },
      _resetWarnings: function () {
        e = {};
      },
      objectCreate:
        Object.create ||
        (function () {
          var a = function () {};
          return function (b) {
            if (arguments.length > 1)
              throw Error('Second argument not supported');
            if ('object' != typeof b)
              throw TypeError('Argument must be an object');
            a.prototype = b;
            var c = new a();
            return (a.prototype = null), c;
          };
        })(),
    },
    g = {
      namespace: 'data-parsley-',
      inputs: 'input, textarea, select',
      excluded:
        'input[type=button], input[type=submit], input[type=reset], input[type=hidden]',
      priorityEnabled: !0,
      multiple: null,
      group: null,
      uiEnabled: !0,
      validationThreshold: 3,
      focus: 'first',
      trigger: !1,
      errorClass: 'parsley-error',
      successClass: 'parsley-success',
      classHandler: function () {},
      errorsContainer: function () {},
      errorsWrapper: '<ul class="parsley-errors-list"></ul>',
      errorTemplate: '<li></li>',
    },
    h = function () {};
  h.prototype = {
    asyncSupport: !1,
    actualizeOptions: function () {
      return (
        f.attr(this.$element, this.options.namespace, this.domOptions),
        this.parent &&
          this.parent.actualizeOptions &&
          this.parent.actualizeOptions(),
        this
      );
    },
    _resetOptions: function (a) {
      (this.domOptions = f.objectCreate(this.parent.options)),
        (this.options = f.objectCreate(this.domOptions));
      for (var b in a) a.hasOwnProperty(b) && (this.options[b] = a[b]);
      this.actualizeOptions();
    },
    validateThroughValidator: function (a, b, c) {
      return window.ParsleyValidator.validate(a, b, c);
    },
    _listeners: null,
    on: function (a, b) {
      this._listeners = this._listeners || {};
      var c = (this._listeners[a] = this._listeners[a] || []);
      return c.push(b), this;
    },
    subscribe: function (b, c) {
      a.listenTo(this, b.toLowerCase(), c);
    },
    off: function (a, b) {
      var c = this._listeners && this._listeners[a];
      if (c)
        if (b) for (var d = c.length; d--; ) c[d] === b && c.splice(d, 1);
        else delete this._listeners[a];
      return this;
    },
    unsubscribe: function (b) {
      a.unsubscribeTo(this, b.toLowerCase());
    },
    trigger: function (a, b) {
      b = b || this;
      var c,
        d = this._listeners && this._listeners[a];
      if (d)
        for (var e = d.length; e--; )
          if (((c = d[e].call(b, b)), c === !1)) return c;
      return this.parent ? this.parent.trigger(a, b) : !0;
    },
    reset: function () {
      if ('ParsleyForm' !== this.__class__) return this._trigger('reset');
      for (var a = 0; a < this.fields.length; a++)
        this.fields[a]._trigger('reset');
      this._trigger('reset');
    },
    destroy: function () {
      if ('ParsleyForm' !== this.__class__)
        return (
          this.$element.removeData('Parsley'),
          this.$element.removeData('ParsleyFieldMultiple'),
          void this._trigger('destroy')
        );
      for (var a = 0; a < this.fields.length; a++) this.fields[a].destroy();
      this.$element.removeData('Parsley'), this._trigger('destroy');
    },
    _findRelatedMultiple: function () {
      return this.parent.$element.find(
        '[' +
          this.options.namespace +
          'multiple="' +
          this.options.multiple +
          '"]'
      );
    },
  };
  var i = (function () {
    var a = {},
      b = function (a) {
        (this.__class__ = 'Validator'),
          (this.__version__ = '1.0.1'),
          (this.options = a || {}),
          (this.bindingKey =
            this.options.bindingKey || '_validatorjsConstraint');
      };
    (b.prototype = {
      constructor: b,
      validate: function (a, b, c) {
        if ('string' != typeof a && 'object' != typeof a)
          throw new Error('You must validate an object or a string');
        return 'string' == typeof a || g(a)
          ? this._validateString(a, b, c)
          : this.isBinded(a)
          ? this._validateBindedObject(a, b)
          : this._validateObject(a, b, c);
      },
      bind: function (a, b) {
        if ('object' != typeof a)
          throw new Error('Must bind a Constraint to an object');
        return (a[this.bindingKey] = new c(b)), this;
      },
      unbind: function (a) {
        return 'undefined' == typeof a._validatorjsConstraint
          ? this
          : (delete a[this.bindingKey], this);
      },
      isBinded: function (a) {
        return 'undefined' != typeof a[this.bindingKey];
      },
      getBinded: function (a) {
        return this.isBinded(a) ? a[this.bindingKey] : null;
      },
      _validateString: function (a, b, c) {
        var f,
          h = [];
        g(b) || (b = [b]);
        for (var i = 0; i < b.length; i++) {
          if (!(b[i] instanceof e))
            throw new Error(
              'You must give an Assert or an Asserts array to validate a string'
            );
          (f = b[i].check(a, c)), f instanceof d && h.push(f);
        }
        return h.length ? h : !0;
      },
      _validateObject: function (a, b, d) {
        if ('object' != typeof b)
          throw new Error('You must give a constraint to validate an object');
        return b instanceof c ? b.check(a, d) : new c(b).check(a, d);
      },
      _validateBindedObject: function (a, b) {
        return a[this.bindingKey].check(a, b);
      },
    }),
      (b.errorCode = {
        must_be_a_string: 'must_be_a_string',
        must_be_an_array: 'must_be_an_array',
        must_be_a_number: 'must_be_a_number',
        must_be_a_string_or_array: 'must_be_a_string_or_array',
      });
    var c = function (a, b) {
      if (
        ((this.__class__ = 'Constraint'),
        (this.options = b || {}),
        (this.nodes = {}),
        a)
      )
        try {
          this._bootstrap(a);
        } catch (c) {
          throw new Error(
            'Should give a valid mapping object to Constraint',
            c,
            a
          );
        }
    };
    c.prototype = {
      constructor: c,
      check: function (a, b) {
        var c,
          d = {};
        for (var h in this.nodes) {
          for (
            var i = !1, j = this.get(h), k = g(j) ? j : [j], l = k.length - 1;
            l >= 0;
            l--
          )
            'Required' !== k[l].__class__ || (i = k[l].requiresValidation(b));
          if (this.has(h, a) || this.options.strict || i)
            try {
              this.has(h, this.options.strict || i ? a : void 0) ||
                new e().HaveProperty(h).validate(a),
                (c = this._check(h, a[h], b)),
                ((g(c) && c.length > 0) || (!g(c) && !f(c))) && (d[h] = c);
            } catch (m) {
              d[h] = m;
            }
        }
        return f(d) ? !0 : d;
      },
      add: function (a, b) {
        if (b instanceof e || (g(b) && b[0] instanceof e))
          return (this.nodes[a] = b), this;
        if ('object' == typeof b && !g(b))
          return (this.nodes[a] = b instanceof c ? b : new c(b)), this;
        throw new Error(
          'Should give an Assert, an Asserts array, a Constraint',
          b
        );
      },
      has: function (a, b) {
        return (
          (b = 'undefined' != typeof b ? b : this.nodes),
          'undefined' != typeof b[a]
        );
      },
      get: function (a, b) {
        return this.has(a) ? this.nodes[a] : b || null;
      },
      remove: function (a) {
        var b = [];
        for (var c in this.nodes) c !== a && (b[c] = this.nodes[c]);
        return (this.nodes = b), this;
      },
      _bootstrap: function (a) {
        if (a instanceof c) return (this.nodes = a.nodes);
        for (var b in a) this.add(b, a[b]);
      },
      _check: function (a, b, d) {
        if (this.nodes[a] instanceof e)
          return this._checkAsserts(b, [this.nodes[a]], d);
        if (g(this.nodes[a])) return this._checkAsserts(b, this.nodes[a], d);
        if (this.nodes[a] instanceof c) return this.nodes[a].check(b, d);
        throw new Error('Invalid node', this.nodes[a]);
      },
      _checkAsserts: function (a, b, c) {
        for (var d, e = [], f = 0; f < b.length; f++)
          (d = b[f].check(a, c)),
            'undefined' != typeof d && !0 !== d && e.push(d);
        return e;
      },
    };
    var d = function (a, b, c) {
      if (((this.__class__ = 'Violation'), !(a instanceof e)))
        throw new Error(
          'Should give an assertion implementing the Assert interface'
        );
      (this.assert = a),
        (this.value = b),
        'undefined' != typeof c && (this.violation = c);
    };
    d.prototype = {
      show: function () {
        var a = { assert: this.assert.__class__, value: this.value };
        return this.violation && (a.violation = this.violation), a;
      },
      __toString: function () {
        return (
          'undefined' != typeof this.violation &&
            (this.violation =
              '", ' +
              this.getViolation().constraint +
              ' expected was ' +
              this.getViolation().expected),
          this.assert.__class__ +
            ' assert failed for "' +
            this.value +
            this.violation || ''
        );
      },
      getViolation: function () {
        var a, b;
        for (a in this.violation) b = this.violation[a];
        return { constraint: a, expected: b };
      },
    };
    var e = function (a) {
      (this.__class__ = 'Assert'),
        (this.__parentClass__ = this.__class__),
        (this.groups = []),
        'undefined' != typeof a && this.addGroup(a);
    };
    (e.prototype = {
      construct: e,
      requiresValidation: function (a) {
        return a && !this.hasGroup(a) ? !1 : !a && this.hasGroups() ? !1 : !0;
      },
      check: function (a, b) {
        if (this.requiresValidation(b))
          try {
            return this.validate(a, b);
          } catch (c) {
            return c;
          }
      },
      hasGroup: function (a) {
        return g(a)
          ? this.hasOneOf(a)
          : 'Any' === a
          ? !0
          : this.hasGroups()
          ? -1 !== this.groups.indexOf(a)
          : 'Default' === a;
      },
      hasOneOf: function (a) {
        for (var b = 0; b < a.length; b++) if (this.hasGroup(a[b])) return !0;
        return !1;
      },
      hasGroups: function () {
        return this.groups.length > 0;
      },
      addGroup: function (a) {
        return g(a)
          ? this.addGroups(a)
          : (this.hasGroup(a) || this.groups.push(a), this);
      },
      removeGroup: function (a) {
        for (var b = [], c = 0; c < this.groups.length; c++)
          a !== this.groups[c] && b.push(this.groups[c]);
        return (this.groups = b), this;
      },
      addGroups: function (a) {
        for (var b = 0; b < a.length; b++) this.addGroup(a[b]);
        return this;
      },
      HaveProperty: function (a) {
        return (
          (this.__class__ = 'HaveProperty'),
          (this.node = a),
          (this.validate = function (a) {
            if ('undefined' == typeof a[this.node])
              throw new d(this, a, { value: this.node });
            return !0;
          }),
          this
        );
      },
      Blank: function () {
        return (
          (this.__class__ = 'Blank'),
          (this.validate = function (a) {
            if ('string' != typeof a)
              throw new d(this, a, { value: b.errorCode.must_be_a_string });
            if ('' !== a.replace(/^\s+/g, '').replace(/\s+$/g, ''))
              throw new d(this, a);
            return !0;
          }),
          this
        );
      },
      Callback: function (a) {
        if (
          ((this.__class__ = 'Callback'),
          (this.arguments = Array.prototype.slice.call(arguments)),
          1 === this.arguments.length
            ? (this.arguments = [])
            : this.arguments.splice(0, 1),
          'function' != typeof a)
        )
          throw new Error('Callback must be instanciated with a function');
        return (
          (this.fn = a),
          (this.validate = function (a) {
            var b = this.fn.apply(this, [a].concat(this.arguments));
            if (!0 !== b) throw new d(this, a, { result: b });
            return !0;
          }),
          this
        );
      },
      Choice: function (a) {
        if (((this.__class__ = 'Choice'), !g(a) && 'function' != typeof a))
          throw new Error(
            'Choice must be instanciated with an array or a function'
          );
        return (
          (this.list = a),
          (this.validate = function (a) {
            for (
              var b = 'function' == typeof this.list ? this.list() : this.list,
                c = 0;
              c < b.length;
              c++
            )
              if (a === b[c]) return !0;
            throw new d(this, a, { choices: b });
          }),
          this
        );
      },
      Collection: function (a) {
        return (
          (this.__class__ = 'Collection'),
          (this.constraint =
            'undefined' != typeof a ? (a instanceof e ? a : new c(a)) : !1),
          (this.validate = function (a, c) {
            var e,
              h = new b(),
              i = 0,
              j = {},
              k = this.groups.length ? this.groups : c;
            if (!g(a))
              throw new d(this, a, { value: b.errorCode.must_be_an_array });
            for (var l = 0; l < a.length; l++)
              (e = this.constraint
                ? h.validate(a[l], this.constraint, k)
                : h.validate(a[l], k)),
                f(e) || (j[i] = e),
                i++;
            return f(j) ? !0 : j;
          }),
          this
        );
      },
      Count: function (a) {
        return (
          (this.__class__ = 'Count'),
          (this.count = a),
          (this.validate = function (a) {
            if (!g(a))
              throw new d(this, a, { value: b.errorCode.must_be_an_array });
            var c =
              'function' == typeof this.count ? this.count(a) : this.count;
            if (isNaN(Number(c)))
              throw new Error('Count must be a valid interger', c);
            if (c !== a.length) throw new d(this, a, { count: c });
            return !0;
          }),
          this
        );
      },
      Email: function () {
        return (
          (this.__class__ = 'Email'),
          (this.validate = function (a) {
            var c =
              /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
            if ('string' != typeof a)
              throw new d(this, a, { value: b.errorCode.must_be_a_string });
            if (!c.test(a)) throw new d(this, a);
            return !0;
          }),
          this
        );
      },
      EqualTo: function (a) {
        if (((this.__class__ = 'EqualTo'), 'undefined' == typeof a))
          throw new Error(
            'EqualTo must be instanciated with a value or a function'
          );
        return (
          (this.reference = a),
          (this.validate = function (a) {
            var b =
              'function' == typeof this.reference
                ? this.reference(a)
                : this.reference;
            if (b !== a) throw new d(this, a, { value: b });
            return !0;
          }),
          this
        );
      },
      GreaterThan: function (a) {
        if (((this.__class__ = 'GreaterThan'), 'undefined' == typeof a))
          throw new Error('Should give a threshold value');
        return (
          (this.threshold = a),
          (this.validate = function (a) {
            if ('' === a || isNaN(Number(a)))
              throw new d(this, a, { value: b.errorCode.must_be_a_number });
            if (this.threshold >= a)
              throw new d(this, a, { threshold: this.threshold });
            return !0;
          }),
          this
        );
      },
      GreaterThanOrEqual: function (a) {
        if (((this.__class__ = 'GreaterThanOrEqual'), 'undefined' == typeof a))
          throw new Error('Should give a threshold value');
        return (
          (this.threshold = a),
          (this.validate = function (a) {
            if ('' === a || isNaN(Number(a)))
              throw new d(this, a, { value: b.errorCode.must_be_a_number });
            if (this.threshold > a)
              throw new d(this, a, { threshold: this.threshold });
            return !0;
          }),
          this
        );
      },
      InstanceOf: function (a) {
        if (((this.__class__ = 'InstanceOf'), 'undefined' == typeof a))
          throw new Error('InstanceOf must be instanciated with a value');
        return (
          (this.classRef = a),
          (this.validate = function (a) {
            if (!0 != a instanceof this.classRef)
              throw new d(this, a, { classRef: this.classRef });
            return !0;
          }),
          this
        );
      },
      Length: function (a) {
        if (((this.__class__ = 'Length'), !a.min && !a.max))
          throw new Error(
            'Lenth assert must be instanciated with a { min: x, max: y } object'
          );
        return (
          (this.min = a.min),
          (this.max = a.max),
          (this.validate = function (a) {
            if ('string' != typeof a && !g(a))
              throw new d(this, a, {
                value: b.errorCode.must_be_a_string_or_array,
              });
            if (
              'undefined' != typeof this.min &&
              this.min === this.max &&
              a.length !== this.min
            )
              throw new d(this, a, { min: this.min, max: this.max });
            if ('undefined' != typeof this.max && a.length > this.max)
              throw new d(this, a, { max: this.max });
            if ('undefined' != typeof this.min && a.length < this.min)
              throw new d(this, a, { min: this.min });
            return !0;
          }),
          this
        );
      },
      LessThan: function (a) {
        if (((this.__class__ = 'LessThan'), 'undefined' == typeof a))
          throw new Error('Should give a threshold value');
        return (
          (this.threshold = a),
          (this.validate = function (a) {
            if ('' === a || isNaN(Number(a)))
              throw new d(this, a, { value: b.errorCode.must_be_a_number });
            if (this.threshold <= a)
              throw new d(this, a, { threshold: this.threshold });
            return !0;
          }),
          this
        );
      },
      LessThanOrEqual: function (a) {
        if (((this.__class__ = 'LessThanOrEqual'), 'undefined' == typeof a))
          throw new Error('Should give a threshold value');
        return (
          (this.threshold = a),
          (this.validate = function (a) {
            if ('' === a || isNaN(Number(a)))
              throw new d(this, a, { value: b.errorCode.must_be_a_number });
            if (this.threshold < a)
              throw new d(this, a, { threshold: this.threshold });
            return !0;
          }),
          this
        );
      },
      NotNull: function () {
        return (
          (this.__class__ = 'NotNull'),
          (this.validate = function (a) {
            if (null === a || 'undefined' == typeof a) throw new d(this, a);
            return !0;
          }),
          this
        );
      },
      NotBlank: function () {
        return (
          (this.__class__ = 'NotBlank'),
          (this.validate = function (a) {
            if ('string' != typeof a)
              throw new d(this, a, { value: b.errorCode.must_be_a_string });
            if ('' === a.replace(/^\s+/g, '').replace(/\s+$/g, ''))
              throw new d(this, a);
            return !0;
          }),
          this
        );
      },
      Null: function () {
        return (
          (this.__class__ = 'Null'),
          (this.validate = function (a) {
            if (null !== a) throw new d(this, a);
            return !0;
          }),
          this
        );
      },
      Range: function (a, b) {
        if (
          ((this.__class__ = 'Range'),
          'undefined' == typeof a || 'undefined' == typeof b)
        )
          throw new Error('Range assert expects min and max values');
        return (
          (this.min = a),
          (this.max = b),
          (this.validate = function (a) {
            try {
              return (
                ('string' == typeof a && isNaN(Number(a))) || g(a)
                  ? new e().Length({ min: this.min, max: this.max }).validate(a)
                  : new e().GreaterThanOrEqual(this.min).validate(a) &&
                    new e().LessThanOrEqual(this.max).validate(a),
                !0
              );
            } catch (b) {
              throw new d(this, a, b.violation);
            }
            return !0;
          }),
          this
        );
      },
      Regexp: function (a, c) {
        if (((this.__class__ = 'Regexp'), 'undefined' == typeof a))
          throw new Error('You must give a regexp');
        return (
          (this.regexp = a),
          (this.flag = c || ''),
          (this.validate = function (a) {
            if ('string' != typeof a)
              throw new d(this, a, { value: b.errorCode.must_be_a_string });
            if (!new RegExp(this.regexp, this.flag).test(a))
              throw new d(this, a, { regexp: this.regexp, flag: this.flag });
            return !0;
          }),
          this
        );
      },
      Required: function () {
        return (
          (this.__class__ = 'Required'),
          (this.validate = function (a) {
            if ('undefined' == typeof a) throw new d(this, a);
            try {
              'string' == typeof a
                ? new e().NotNull().validate(a) &&
                  new e().NotBlank().validate(a)
                : !0 === g(a) && new e().Length({ min: 1 }).validate(a);
            } catch (b) {
              throw new d(this, a);
            }
            return !0;
          }),
          this
        );
      },
      Unique: function (a) {
        return (
          (this.__class__ = 'Unique'),
          'object' == typeof a && (this.key = a.key),
          (this.validate = function (a) {
            var c,
              e = [];
            if (!g(a))
              throw new d(this, a, { value: b.errorCode.must_be_an_array });
            for (var f = 0; f < a.length; f++)
              if (
                ((c = 'object' == typeof a[f] ? a[f][this.key] : a[f]),
                'undefined' != typeof c)
              ) {
                if (-1 !== e.indexOf(c)) throw new d(this, a, { value: c });
                e.push(c);
              }
            return !0;
          }),
          this
        );
      },
    }),
      (a.Assert = e),
      (a.Validator = b),
      (a.Violation = d),
      (a.Constraint = c),
      Array.prototype.indexOf ||
        (Array.prototype.indexOf = function (a) {
          'use strict';
          if (null === this) throw new TypeError();
          var b = Object(this),
            c = b.length >>> 0;
          if (0 === c) return -1;
          var d = 0;
          if (
            (arguments.length > 1 &&
              ((d = Number(arguments[1])),
              d != d
                ? (d = 0)
                : 0 !== d &&
                  d != 1 / 0 &&
                  d != -(1 / 0) &&
                  (d = (d > 0 || -1) * Math.floor(Math.abs(d)))),
            d >= c)
          )
            return -1;
          for (var e = d >= 0 ? d : Math.max(c - Math.abs(d), 0); c > e; e++)
            if (e in b && b[e] === a) return e;
          return -1;
        });
    var f = function (a) {
        for (var b in a) return !1;
        return !0;
      },
      g = function (a) {
        return '[object Array]' === Object.prototype.toString.call(a);
      };
    return (
      'function' == typeof define && define.amd
        ? define('vendors/validator.js/dist/validator', [], function () {
            return a;
          })
        : 'undefined' != typeof module && module.exports
        ? (module.exports = a)
        : (window[
            'undefined' != typeof validatorjs_ns ? validatorjs_ns : 'Validator'
          ] = a),
      a
    );
  })();
  i =
    'undefined' != typeof i
      ? i
      : 'undefined' != typeof module
      ? module.exports
      : null;
  var j = function (a, b) {
    (this.__class__ = 'ParsleyValidator'),
      (this.Validator = i),
      (this.locale = 'en'),
      this.init(a || {}, b || {});
  };
  j.prototype = {
    init: function (b, c) {
      (this.catalog = c), (this.validators = a.extend({}, this.validators));
      for (var d in b)
        this.addValidator(
          d,
          b[d].fn,
          b[d].priority,
          b[d].requirementsTransformer
        );
      window.Parsley.trigger('parsley:validator:init');
    },
    setLocale: function (a) {
      if ('undefined' == typeof this.catalog[a])
        throw new Error(a + ' is not available in the catalog');
      return (this.locale = a), this;
    },
    addCatalog: function (a, b, c) {
      return (
        'object' == typeof b && (this.catalog[a] = b),
        !0 === c ? this.setLocale(a) : this
      );
    },
    addMessage: function (a, b, c) {
      return (
        'undefined' == typeof this.catalog[a] && (this.catalog[a] = {}),
        (this.catalog[a][b.toLowerCase()] = c),
        this
      );
    },
    validate: function () {
      return new this.Validator.Validator().validate.apply(
        new i.Validator(),
        arguments
      );
    },
    addValidator: function (a, b, c, d) {
      if (this.validators[a])
        f.warn('Validator "' + a + '" is already defined.');
      else if (g.hasOwnProperty(a))
        return void f.warn(
          '"' +
            a +
            '" is a restricted keyword and is not a valid validator name.'
        );
      return this._setValidator(a, b, c, d);
    },
    updateValidator: function (a, b, c, d) {
      return this.validators[a]
        ? this._setValidator(a, b, c, d)
        : (f.warn('Validator "' + a + '" is not already defined.'),
          this.addValidator(a, b, c, d));
    },
    removeValidator: function (a) {
      return (
        this.validators[a] || f.warn('Validator "' + a + '" is not defined.'),
        delete this.validators[a],
        this
      );
    },
    _setValidator: function (b, c, d, e) {
      return (
        (this.validators[b] = function (b) {
          return a.extend(new i.Assert().Callback(c, b), {
            priority: d,
            requirementsTransformer: e,
          });
        }),
        this
      );
    },
    getErrorMessage: function (a) {
      var b;
      if ('type' === a.name) {
        var c = this.catalog[this.locale][a.name] || {};
        b = c[a.requirements];
      } else
        b = this.formatMessage(
          this.catalog[this.locale][a.name],
          a.requirements
        );
      return (
        b ||
        this.catalog[this.locale].defaultMessage ||
        this.catalog.en.defaultMessage
      );
    },
    formatMessage: function (a, b) {
      if ('object' == typeof b) {
        for (var c in b) a = this.formatMessage(a, b[c]);
        return a;
      }
      return 'string' == typeof a ? a.replace(new RegExp('%s', 'i'), b) : '';
    },
    validators: {
      notblank: function () {
        return a.extend(new i.Assert().NotBlank(), { priority: 2 });
      },
      required: function () {
        return a.extend(new i.Assert().Required(), { priority: 512 });
      },
      type: function (b) {
        var c;
        switch (b) {
          case 'email':
            c = new i.Assert().Email();
            break;
          case 'range':
          case 'number':
            c = new i.Assert().Regexp(
              '^-?(?:\\d+|\\d{1,3}(?:,\\d{3})+)?(?:\\.\\d+)?$'
            );
            break;
          case 'integer':
            c = new i.Assert().Regexp('^-?\\d+$');
            break;
          case 'digits':
            c = new i.Assert().Regexp('^\\d+$');
            break;
          case 'alphanum':
            c = new i.Assert().Regexp('^\\w+$', 'i');
            break;
          case 'url':
            c = new i.Assert().Regexp(
              '^(?:(?:https?|ftp)://)?(?:\\S+(?::\\S*)?@)?(?:(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,})))(?::\\d{2,5})?(?:/\\S*)?$',
              'i'
            );
            break;
          default:
            throw new Error('validator type `' + b + '` is not supported');
        }
        return a.extend(c, { priority: 256 });
      },
      pattern: function (b) {
        var c = '';
        return (
          /^\/.*\/(?:[gimy]*)$/.test(b) &&
            ((c = b.replace(/.*\/([gimy]*)$/, '$1')),
            (b = b.replace(new RegExp('^/(.*?)/' + c + '$'), '$1'))),
          a.extend(new i.Assert().Regexp(b, c), { priority: 64 })
        );
      },
      minlength: function (b) {
        return a.extend(new i.Assert().Length({ min: b }), {
          priority: 30,
          requirementsTransformer: function () {
            return 'string' != typeof b || isNaN(b) ? b : parseInt(b, 10);
          },
        });
      },
      maxlength: function (b) {
        return a.extend(new i.Assert().Length({ max: b }), {
          priority: 30,
          requirementsTransformer: function () {
            return 'string' != typeof b || isNaN(b) ? b : parseInt(b, 10);
          },
        });
      },
      length: function (b) {
        return a.extend(new i.Assert().Length({ min: b[0], max: b[1] }), {
          priority: 32,
        });
      },
      mincheck: function (a) {
        return this.minlength(a);
      },
      maxcheck: function (a) {
        return this.maxlength(a);
      },
      check: function (a) {
        return this.length(a);
      },
      min: function (b) {
        return a.extend(new i.Assert().GreaterThanOrEqual(b), {
          priority: 30,
          requirementsTransformer: function () {
            return 'string' != typeof b || isNaN(b) ? b : parseInt(b, 10);
          },
        });
      },
      max: function (b) {
        return a.extend(new i.Assert().LessThanOrEqual(b), {
          priority: 30,
          requirementsTransformer: function () {
            return 'string' != typeof b || isNaN(b) ? b : parseInt(b, 10);
          },
        });
      },
      range: function (b) {
        return a.extend(new i.Assert().Range(b[0], b[1]), {
          priority: 32,
          requirementsTransformer: function () {
            for (var a = 0; a < b.length; a++)
              b[a] =
                'string' != typeof b[a] || isNaN(b[a])
                  ? b[a]
                  : parseInt(b[a], 10);
            return b;
          },
        });
      },
      equalto: function (b) {
        return a.extend(new i.Assert().EqualTo(b), {
          priority: 256,
          requirementsTransformer: function () {
            return a(b).length ? a(b).val() : b;
          },
        });
      },
    },
  };
  var k = function () {
    this.__class__ = 'ParsleyUI';
  };
  k.prototype = {
    listen: function () {
      var a = this;
      return (
        window.Parsley.on('form:init', function () {
          a.setupForm(this);
        })
          .on('field:init', function () {
            a.setupField(this);
          })
          .on('field:validated', function () {
            a.reflow(this);
          })
          .on('form:validated', function () {
            a.focus(this);
          })
          .on('field:reset', function () {
            a.reset(this);
          })
          .on('form:destroy', function () {
            a.destroy(this);
          })
          .on('field:destroy', function () {
            a.destroy(this);
          }),
        this
      );
    },
    reflow: function (a) {
      if ('undefined' != typeof a._ui && !1 !== a._ui.active) {
        var b = this._diff(a.validationResult, a._ui.lastValidationResult);
        (a._ui.lastValidationResult = a.validationResult),
          (a._ui.validatedOnce = !0),
          this.manageStatusClass(a),
          this.manageErrorsMessages(a, b),
          this.actualizeTriggers(a),
          (b.kept.length || b.added.length) &&
            !0 !== a._ui.failedOnce &&
            this.manageFailingFieldTrigger(a);
      }
    },
    getErrorsMessages: function (a) {
      if (!0 === a.validationResult) return [];
      for (var b = [], c = 0; c < a.validationResult.length; c++)
        b.push(this._getErrorMessage(a, a.validationResult[c].assert));
      return b;
    },
    manageStatusClass: function (a) {
      a.hasConstraints() && a.needsValidation() && !0 === a.validationResult
        ? this._successClass(a)
        : a.validationResult.length > 0
        ? this._errorClass(a)
        : this._resetClass(a);
    },
    manageErrorsMessages: function (b, c) {
      if ('undefined' == typeof b.options.errorsMessagesDisabled) {
        if ('undefined' != typeof b.options.errorMessage)
          return c.added.length || c.kept.length
            ? (this._insertErrorWrapper(b),
              0 ===
                b._ui.$errorsWrapper.find('.parsley-custom-error-message')
                  .length &&
                b._ui.$errorsWrapper.append(
                  a(b.options.errorTemplate).addClass(
                    'parsley-custom-error-message'
                  )
                ),
              b._ui.$errorsWrapper
                .addClass('filled')
                .find('.parsley-custom-error-message')
                .html(b.options.errorMessage))
            : b._ui.$errorsWrapper
                .removeClass('filled')
                .find('.parsley-custom-error-message')
                .remove();
        for (var d = 0; d < c.removed.length; d++)
          this.removeError(b, c.removed[d].assert.name, !0);
        for (d = 0; d < c.added.length; d++)
          this.addError(
            b,
            c.added[d].assert.name,
            void 0,
            c.added[d].assert,
            !0
          );
        for (d = 0; d < c.kept.length; d++)
          this.updateError(
            b,
            c.kept[d].assert.name,
            void 0,
            c.kept[d].assert,
            !0
          );
      }
    },
    addError: function (b, c, d, e, f) {
      this._insertErrorWrapper(b),
        b._ui.$errorsWrapper.addClass('filled').append(
          a(b.options.errorTemplate)
            .addClass('parsley-' + c)
            .html(d || this._getErrorMessage(b, e))
        ),
        !0 !== f && this._errorClass(b);
    },
    updateError: function (a, b, c, d, e) {
      a._ui.$errorsWrapper
        .addClass('filled')
        .find('.parsley-' + b)
        .html(c || this._getErrorMessage(a, d)),
        !0 !== e && this._errorClass(a);
    },
    removeError: function (a, b, c) {
      a._ui.$errorsWrapper
        .removeClass('filled')
        .find('.parsley-' + b)
        .remove(),
        !0 !== c && this.manageStatusClass(a);
    },
    focus: function (a) {
      if (
        ((a._focusedField = null),
        !0 === a.validationResult || 'none' === a.options.focus)
      )
        return null;
      for (var b = 0; b < a.fields.length; b++) {
        var c = a.fields[b];
        if (
          !0 !== c.validationResult &&
          c.validationResult.length > 0 &&
          'undefined' == typeof c.options.noFocus &&
          ((a._focusedField = c.$element), 'first' === a.options.focus)
        )
          break;
      }
      return null === a._focusedField ? null : a._focusedField.focus();
    },
    _getErrorMessage: function (a, b) {
      var c = b.name + 'Message';
      return 'undefined' != typeof a.options[c]
        ? window.ParsleyValidator.formatMessage(a.options[c], b.requirements)
        : window.ParsleyValidator.getErrorMessage(b);
    },
    _diff: function (a, b, c) {
      for (var d = [], e = [], f = 0; f < a.length; f++) {
        for (var g = !1, h = 0; h < b.length; h++)
          if (a[f].assert.name === b[h].assert.name) {
            g = !0;
            break;
          }
        g ? e.push(a[f]) : d.push(a[f]);
      }
      return {
        kept: e,
        added: d,
        removed: c ? [] : this._diff(b, a, !0).added,
      };
    },
    setupForm: function (b) {
      b.$element.on('submit.Parsley', !1, a.proxy(b.onSubmitValidate, b)),
        !1 !== b.options.uiEnabled && b.$element.attr('novalidate', '');
    },
    setupField: function (b) {
      var c = { active: !1 };
      !1 !== b.options.uiEnabled &&
        ((c.active = !0),
        b.$element.attr(b.options.namespace + 'id', b.__id__),
        (c.$errorClassHandler = this._manageClassHandler(b)),
        (c.errorsWrapperId =
          'parsley-id-' +
          (b.options.multiple ? 'multiple-' + b.options.multiple : b.__id__)),
        (c.$errorsWrapper = a(b.options.errorsWrapper).attr(
          'id',
          c.errorsWrapperId
        )),
        (c.lastValidationResult = []),
        (c.validatedOnce = !1),
        (c.validationInformationVisible = !1),
        (b._ui = c),
        this.actualizeTriggers(b));
    },
    _manageClassHandler: function (b) {
      if (
        'string' == typeof b.options.classHandler &&
        a(b.options.classHandler).length
      )
        return a(b.options.classHandler);
      var c = b.options.classHandler(b);
      return 'undefined' != typeof c && c.length
        ? c
        : !b.options.multiple || b.$element.is('select')
        ? b.$element
        : b.$element.parent();
    },
    _insertErrorWrapper: function (b) {
      var c;
      if (0 !== b._ui.$errorsWrapper.parent().length)
        return b._ui.$errorsWrapper.parent();
      if ('string' == typeof b.options.errorsContainer) {
        if (a(b.options.errorsContainer).length)
          return a(b.options.errorsContainer).append(b._ui.$errorsWrapper);
        f.warn(
          'The errors container `' +
            b.options.errorsContainer +
            '` does not exist in DOM'
        );
      } else
        'function' == typeof b.options.errorsContainer &&
          (c = b.options.errorsContainer(b));
      if ('undefined' != typeof c && c.length)
        return c.append(b._ui.$errorsWrapper);
      var d = b.$element;
      return (
        b.options.multiple && (d = d.parent()), d.after(b._ui.$errorsWrapper)
      );
    },
    actualizeTriggers: function (b) {
      var c = b.$element;
      if (
        (b.options.multiple &&
          (c = a(
            '[' + b.options.namespace + 'multiple="' + b.options.multiple + '"]'
          )),
        c.off('.Parsley'),
        !1 !== b.options.trigger)
      ) {
        var d = b.options.trigger.replace(/^\s+/g, '').replace(/\s+$/g, '');
        '' !== d &&
          c.on(
            d.split(' ').join('.Parsley ') + '.Parsley',
            a.proxy(
              'function' == typeof b.eventValidate
                ? b.eventValidate
                : this.eventValidate,
              b
            )
          );
      }
    },
    eventValidate: function (a) {
      (new RegExp('key').test(a.type) &&
        !this._ui.validationInformationVisible &&
        this.getValue().length <= this.options.validationThreshold) ||
        ((this._ui.validatedOnce = !0), this.validate());
    },
    manageFailingFieldTrigger: function (b) {
      return (
        (b._ui.failedOnce = !0),
        b.options.multiple &&
          a(
            '[' + b.options.namespace + 'multiple="' + b.options.multiple + '"]'
          ).each(function () {
            return new RegExp('change', 'i').test(
              a(this).parsley().options.trigger || ''
            )
              ? void 0
              : a(this).on(
                  'change.ParsleyFailedOnce',
                  !1,
                  a.proxy(b.validate, b)
                );
          }),
        b.$element.is('select') &&
        !new RegExp('change', 'i').test(b.options.trigger || '')
          ? b.$element.on(
              'change.ParsleyFailedOnce',
              !1,
              a.proxy(b.validate, b)
            )
          : new RegExp('keyup', 'i').test(b.options.trigger || '')
          ? void 0
          : b.$element.on('keyup.ParsleyFailedOnce', !1, a.proxy(b.validate, b))
      );
    },
    reset: function (a) {
      this.actualizeTriggers(a),
        a.$element.off('.ParsleyFailedOnce'),
        'undefined' != typeof a._ui &&
          'ParsleyForm' !== a.__class__ &&
          (a._ui.$errorsWrapper.removeClass('filled').children().remove(),
          this._resetClass(a),
          (a._ui.validatedOnce = !1),
          (a._ui.lastValidationResult = []),
          (a._ui.validationInformationVisible = !1),
          (a._ui.failedOnce = !1));
    },
    destroy: function (a) {
      this.reset(a),
        'ParsleyForm' !== a.__class__ &&
          ('undefined' != typeof a._ui && a._ui.$errorsWrapper.remove(),
          delete a._ui);
    },
    _successClass: function (a) {
      (a._ui.validationInformationVisible = !0),
        a._ui.$errorClassHandler
          .removeClass(a.options.errorClass)
          .addClass(a.options.successClass);
    },
    _errorClass: function (a) {
      (a._ui.validationInformationVisible = !0),
        a._ui.$errorClassHandler
          .removeClass(a.options.successClass)
          .addClass(a.options.errorClass);
    },
    _resetClass: function (a) {
      a._ui.$errorClassHandler
        .removeClass(a.options.successClass)
        .removeClass(a.options.errorClass);
    },
  };
  var l = function (b, c, d) {
    (this.__class__ = 'ParsleyForm'),
      (this.__id__ = f.generateID()),
      (this.$element = a(b)),
      (this.domOptions = c),
      (this.options = d),
      (this.parent = window.Parsley),
      (this.fields = []),
      (this.validationResult = null);
  };
  l.prototype = {
    onSubmitValidate: function (b) {
      return (
        this.validate(void 0, void 0, b),
        (!1 === this.validationResult || !this._trigger('submit')) &&
          b instanceof a.Event &&
          (b.stopImmediatePropagation(), b.preventDefault()),
        this
      );
    },
    validate: function (a, b, c) {
      (this.submitEvent = c), (this.validationResult = !0);
      var d = [];
      return (
        this._trigger('validate'),
        this._refreshFields(),
        this._withoutReactualizingFormOptions(function () {
          for (var c = 0; c < this.fields.length; c++)
            (!a || this._isFieldInGroup(this.fields[c], a)) &&
              ((d = this.fields[c].validate(b)),
              !0 !== d &&
                d.length > 0 &&
                this.validationResult &&
                (this.validationResult = !1));
        }),
        this._trigger(this.validationResult ? 'success' : 'error'),
        this._trigger('validated'),
        this.validationResult
      );
    },
    isValid: function (a, b) {
      return (
        this._refreshFields(),
        this._withoutReactualizingFormOptions(function () {
          for (var c = 0; c < this.fields.length; c++)
            if (
              (!a || this._isFieldInGroup(this.fields[c], a)) &&
              !1 === this.fields[c].isValid(b)
            )
              return !1;
          return !0;
        })
      );
    },
    _isFieldInGroup: function (b, c) {
      return a.isArray(b.options.group)
        ? -1 !== a.inArray(c, b.options.group)
        : b.options.group === c;
    },
    _refreshFields: function () {
      return this.actualizeOptions()._bindFields();
    },
    _bindFields: function () {
      var b = this,
        c = this.fields;
      return (
        (this.fields = []),
        (this.fieldsMappedById = {}),
        this._withoutReactualizingFormOptions(function () {
          this.$element
            .find(this.options.inputs)
            .not(this.options.excluded)
            .each(function () {
              var a = new t.Factory(this, {}, b);
              ('ParsleyField' !== a.__class__ &&
                'ParsleyFieldMultiple' !== a.__class__) ||
                !0 === a.options.excluded ||
                ('undefined' ==
                  typeof b.fieldsMappedById[a.__class__ + '-' + a.__id__] &&
                  ((b.fieldsMappedById[a.__class__ + '-' + a.__id__] = a),
                  b.fields.push(a)));
            }),
            a(c)
              .not(b.fields)
              .each(function () {
                this._trigger('reset');
              });
        }),
        this
      );
    },
    _withoutReactualizingFormOptions: function (a) {
      var b = this.actualizeOptions;
      this.actualizeOptions = function () {
        return this;
      };
      var c = a.call(this);
      return (this.actualizeOptions = b), c;
    },
    _trigger: function (a) {
      return (a = 'form:' + a), this.trigger.apply(this, arguments);
    },
  };
  var m = function (b, c, d, e, g) {
      var h = {};
      if (!new RegExp('ParsleyField').test(b.__class__))
        throw new Error(
          'ParsleyField or ParsleyFieldMultiple instance expected'
        );
      if (
        ('function' == typeof window.ParsleyValidator.validators[c] &&
          (h = window.ParsleyValidator.validators[c](d)),
        'Assert' !== h.__parentClass__)
      )
        throw new Error('Valid validator expected');
      var i = function () {
        return 'undefined' != typeof b.options[c + 'Priority']
          ? b.options[c + 'Priority']
          : h.priority || 2;
      };
      return (
        (e = e || i()),
        'function' == typeof h.requirementsTransformer &&
          ((d = h.requirementsTransformer()),
          (h = window.ParsleyValidator.validators[c](d))),
        a.extend(h, {
          name: c,
          requirements: d,
          priority: e,
          groups: [e],
          isDomConstraint: g || f.checkAttr(b.$element, b.options.namespace, c),
        })
      );
    },
    n = function (b, c, d, e) {
      (this.__class__ = 'ParsleyField'),
        (this.__id__ = f.generateID()),
        (this.$element = a(b)),
        'undefined' != typeof e && (this.parent = e),
        (this.options = d),
        (this.domOptions = c),
        (this.constraints = []),
        (this.constraintsByName = {}),
        (this.validationResult = []),
        this._bindConstraints();
    };
  n.prototype = {
    validate: function (a) {
      return (
        (this.value = this.getValue()),
        this._trigger('validate'),
        this._trigger(this.isValid(a, this.value) ? 'success' : 'error'),
        this._trigger('validated'),
        this.validationResult
      );
    },
    hasConstraints: function () {
      return 0 !== this.constraints.length;
    },
    needsValidation: function (a) {
      return (
        'undefined' == typeof a && (a = this.getValue()),
        a.length ||
        this._isRequired() ||
        'undefined' != typeof this.options.validateIfEmpty
          ? !0
          : !1
      );
    },
    isValid: function (a, b) {
      if (
        (this.refreshConstraints(),
        (this.validationResult = !0),
        !this.hasConstraints())
      )
        return !0;
      if (
        (('undefined' == typeof b || null === b) && (b = this.getValue()),
        !this.needsValidation(b) && !0 !== a)
      )
        return !0;
      var c = ['Any'];
      !1 !== this.options.priorityEnabled &&
        (c = this._getConstraintsSortedPriorities());
      for (var d = 0; d < c.length; d++)
        if (
          !0 !==
          (this.validationResult = this.validateThroughValidator(
            b,
            this.constraints,
            c[d]
          ))
        )
          return !1;
      return !0;
    },
    getValue: function () {
      var a;
      return (
        (a =
          'function' == typeof this.options.value
            ? this.options.value(this)
            : 'undefined' != typeof this.options.value
            ? this.options.value
            : this.$element.val()),
        'undefined' == typeof a || null === a
          ? ''
          : !0 === this.options.trimValue
          ? a.replace(/^\s+|\s+$/g, '')
          : a
      );
    },
    refreshConstraints: function () {
      return this.actualizeOptions()._bindConstraints();
    },
    addConstraint: function (a, b, c, d) {
      if ('function' == typeof window.ParsleyValidator.validators[a]) {
        var e = new m(this, a, b, c, d);
        'undefined' !== this.constraintsByName[e.name] &&
          this.removeConstraint(e.name),
          this.constraints.push(e),
          (this.constraintsByName[e.name] = e);
      }
      return this;
    },
    removeConstraint: function (a) {
      for (var b = 0; b < this.constraints.length; b++)
        if (a === this.constraints[b].name) {
          this.constraints.splice(b, 1);
          break;
        }
      return delete this.constraintsByName[a], this;
    },
    updateConstraint: function (a, b, c) {
      return this.removeConstraint(a).addConstraint(a, b, c);
    },
    _bindConstraints: function () {
      for (var a = [], b = {}, c = 0; c < this.constraints.length; c++)
        !1 === this.constraints[c].isDomConstraint &&
          (a.push(this.constraints[c]),
          (b[this.constraints[c].name] = this.constraints[c]));
      (this.constraints = a), (this.constraintsByName = b);
      for (var d in this.options) this.addConstraint(d, this.options[d]);
      return this._bindHtml5Constraints();
    },
    _bindHtml5Constraints: function () {
      (this.$element.hasClass('required') || this.$element.attr('required')) &&
        this.addConstraint('required', !0, void 0, !0),
        'string' == typeof this.$element.attr('pattern') &&
          this.addConstraint(
            'pattern',
            this.$element.attr('pattern'),
            void 0,
            !0
          ),
        'undefined' != typeof this.$element.attr('min') &&
        'undefined' != typeof this.$element.attr('max')
          ? this.addConstraint(
              'range',
              [this.$element.attr('min'), this.$element.attr('max')],
              void 0,
              !0
            )
          : 'undefined' != typeof this.$element.attr('min')
          ? this.addConstraint('min', this.$element.attr('min'), void 0, !0)
          : 'undefined' != typeof this.$element.attr('max') &&
            this.addConstraint('max', this.$element.attr('max'), void 0, !0),
        'undefined' != typeof this.$element.attr('minlength') &&
        'undefined' != typeof this.$element.attr('maxlength')
          ? this.addConstraint(
              'length',
              [
                this.$element.attr('minlength'),
                this.$element.attr('maxlength'),
              ],
              void 0,
              !0
            )
          : 'undefined' != typeof this.$element.attr('minlength')
          ? this.addConstraint(
              'minlength',
              this.$element.attr('minlength'),
              void 0,
              !0
            )
          : 'undefined' != typeof this.$element.attr('maxlength') &&
            this.addConstraint(
              'maxlength',
              this.$element.attr('maxlength'),
              void 0,
              !0
            );
      var a = this.$element.attr('type');
      return 'undefined' == typeof a
        ? this
        : 'number' === a
        ? 'undefined' == typeof this.$element.attr('step') ||
          0 === parseFloat(this.$element.attr('step')) % 1
          ? this.addConstraint('type', 'integer', void 0, !0)
          : this.addConstraint('type', 'number', void 0, !0)
        : /^(email|url|range)$/i.test(a)
        ? this.addConstraint('type', a, void 0, !0)
        : this;
    },
    _isRequired: function () {
      return 'undefined' == typeof this.constraintsByName.required
        ? !1
        : !1 !== this.constraintsByName.required.requirements;
    },
    _trigger: function (a) {
      return (a = 'field:' + a), this.trigger.apply(this, arguments);
    },
    _getConstraintsSortedPriorities: function () {
      for (var a = [], b = 0; b < this.constraints.length; b++)
        -1 === a.indexOf(this.constraints[b].priority) &&
          a.push(this.constraints[b].priority);
      return (
        a.sort(function (a, b) {
          return b - a;
        }),
        a
      );
    },
  };
  var o = function () {
    this.__class__ = 'ParsleyFieldMultiple';
  };
  o.prototype = {
    addElement: function (a) {
      return this.$elements.push(a), this;
    },
    refreshConstraints: function () {
      var b;
      if (((this.constraints = []), this.$element.is('select')))
        return this.actualizeOptions()._bindConstraints(), this;
      for (var c = 0; c < this.$elements.length; c++)
        if (a('html').has(this.$elements[c]).length) {
          b = this.$elements[c]
            .data('ParsleyFieldMultiple')
            .refreshConstraints().constraints;
          for (var d = 0; d < b.length; d++)
            this.addConstraint(
              b[d].name,
              b[d].requirements,
              b[d].priority,
              b[d].isDomConstraint
            );
        } else this.$elements.splice(c, 1);
      return this;
    },
    getValue: function () {
      if ('undefined' != typeof this.options.value) return this.options.value;
      if (this.$element.is('input[type=radio]'))
        return this._findRelatedMultiple().filter(':checked').val() || '';
      if (this.$element.is('input[type=checkbox]')) {
        var b = [];
        return (
          this._findRelatedMultiple()
            .filter(':checked')
            .each(function () {
              b.push(a(this).val());
            }),
          b
        );
      }
      return this.$element.is('select') && null === this.$element.val()
        ? []
        : this.$element.val();
    },
    _init: function () {
      return (this.$elements = [this.$element]), this;
    },
  };
  var p = function (b, c, d) {
    this.$element = a(b);
    var e = this.$element.data('Parsley');
    if (e)
      return (
        'undefined' != typeof d &&
          e.parent === window.Parsley &&
          ((e.parent = d), e._resetOptions(e.options)),
        e
      );
    if (!this.$element.length)
      throw new Error('You must bind Parsley on an existing element.');
    if ('undefined' != typeof d && 'ParsleyForm' !== d.__class__)
      throw new Error('Parent instance must be a ParsleyForm instance');
    return (this.parent = d || window.Parsley), this.init(c);
  };
  p.prototype = {
    init: function (a) {
      return (
        (this.__class__ = 'Parsley'),
        (this.__version__ = '2.1.2'),
        (this.__id__ = f.generateID()),
        this._resetOptions(a),
        this.$element.is('form') ||
        (f.checkAttr(this.$element, this.options.namespace, 'validate') &&
          !this.$element.is(this.options.inputs))
          ? this.bind('parsleyForm')
          : this.isMultiple()
          ? this.handleMultiple()
          : this.bind('parsleyField')
      );
    },
    isMultiple: function () {
      return (
        this.$element.is('input[type=radio], input[type=checkbox]') ||
        (this.$element.is('select') &&
          'undefined' != typeof this.$element.attr('multiple'))
      );
    },
    handleMultiple: function () {
      var b,
        c,
        d = this;
      if (
        (this.options.multiple ||
          ('undefined' != typeof this.$element.attr('name') &&
          this.$element.attr('name').length
            ? (this.options.multiple = b = this.$element.attr('name'))
            : 'undefined' != typeof this.$element.attr('id') &&
              this.$element.attr('id').length &&
              (this.options.multiple = this.$element.attr('id'))),
        this.$element.is('select') &&
          'undefined' != typeof this.$element.attr('multiple'))
      )
        return (
          (this.options.multiple = this.options.multiple || this.__id__),
          this.bind('parsleyFieldMultiple')
        );
      if (!this.options.multiple)
        return (
          f.warn(
            'To be bound by Parsley, a radio, a checkbox and a multiple select input must have either a name or a multiple option.',
            this.$element
          ),
          this
        );
      (this.options.multiple = this.options.multiple.replace(
        /(:|\.|\[|\]|\{|\}|\$)/g,
        ''
      )),
        'undefined' != typeof b &&
          a('input[name="' + b + '"]').each(function () {
            a(this).is('input[type=radio], input[type=checkbox]') &&
              a(this).attr(
                d.options.namespace + 'multiple',
                d.options.multiple
              );
          });
      for (var e = this._findRelatedMultiple(), g = 0; g < e.length; g++)
        if (((c = a(e.get(g)).data('Parsley')), 'undefined' != typeof c)) {
          this.$element.data('ParsleyFieldMultiple') ||
            c.addElement(this.$element);
          break;
        }
      return (
        this.bind('parsleyField', !0), c || this.bind('parsleyFieldMultiple')
      );
    },
    bind: function (b, c) {
      var d;
      switch (b) {
        case 'parsleyForm':
          d = a
            .extend(
              new l(this.$element, this.domOptions, this.options),
              window.ParsleyExtend
            )
            ._bindFields();
          break;
        case 'parsleyField':
          d = a.extend(
            new n(this.$element, this.domOptions, this.options, this.parent),
            window.ParsleyExtend
          );
          break;
        case 'parsleyFieldMultiple':
          d = a
            .extend(
              new n(this.$element, this.domOptions, this.options, this.parent),
              new o(),
              window.ParsleyExtend
            )
            ._init();
          break;
        default:
          throw new Error(b + 'is not a supported Parsley type');
      }
      return (
        this.options.multiple &&
          f.setAttr(
            this.$element,
            this.options.namespace,
            'multiple',
            this.options.multiple
          ),
        'undefined' != typeof c
          ? (this.$element.data('ParsleyFieldMultiple', d), d)
          : (this.$element.data('Parsley', d), d._trigger('init'), d)
      );
    },
  };
  var q = a({}),
    r = function () {
      f.warnOnce(
        "Parsley's pubsub module is deprecated; use the corresponding jQuery event method instead"
      );
    },
    s = 'parsley:';
  (a.listen = function (a, d) {
    var e;
    if (
      (r(),
      'object' == typeof arguments[1] &&
        'function' == typeof arguments[2] &&
        ((e = arguments[1]), (d = arguments[2])),
      'function' != typeof arguments[1])
    )
      throw new Error('Wrong parameters');
    window.Parsley.on(c(a), b(d, e));
  }),
    (a.listenTo = function (a, d, e) {
      if ((r(), !(a instanceof n || a instanceof l)))
        throw new Error('Must give Parsley instance');
      if ('string' != typeof d || 'function' != typeof e)
        throw new Error('Wrong parameters');
      a.on(c(d), b(e));
    }),
    (a.unsubscribe = function (a, b) {
      if ((r(), 'string' != typeof a || 'function' != typeof b))
        throw new Error('Wrong arguments');
      window.Parsley.off(c(a), b.parsleyAdaptedCallback);
    }),
    (a.unsubscribeTo = function (a, b) {
      if ((r(), !(a instanceof n || a instanceof l)))
        throw new Error('Must give Parsley instance');
      a.off(c(b));
    }),
    (a.unsubscribeAll = function (b) {
      r(),
        window.Parsley.off(c(b)),
        a('form,input,textarea,select').each(function () {
          var d = a(this).data('Parsley');
          d && d.off(c(b));
        });
    }),
    (a.emit = function (a, b) {
      r();
      var d = b instanceof n || b instanceof l,
        e = Array.prototype.slice.call(arguments, d ? 2 : 1);
      e.unshift(c(a)), d || (b = window.Parsley), b.trigger.apply(b, e);
    }),
    (window.ParsleyConfig = window.ParsleyConfig || {}),
    (window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {}),
    (window.ParsleyConfig.i18n.en = jQuery.extend(
      window.ParsleyConfig.i18n.en || {},
      {
        defaultMessage: 'E-mail inválido',
        type: {
          email: 'E-mail inválido',
          url: 'URL inválida',
          number: 'Valor inválido',
          integer: 'Valor inválido',
          digits: 'Campo inválido',
          alphanum: 'Campo inválido',
        },
        notblank: 'Campo Obrigatório',
        required: 'Campo Obrigatório.',
        pattern: 'Valor inválido',
        min: 'Este valor deve ser maior ou igual a %s.',
        max: 'Este valor deve ser menor ou igual a %s.',
        range: 'Este valor deve estar entre %s e %s.',
        minlength: 'Este valor é muito curto. Deve ter %s caracteres ou mais.',
        maxlength: 'Este valor é muito longo. Deve ter %s caracteres ou menos.',
        length: 'Valor inválido, deve ter entre %s e %s caracteres.',
        mincheck: 'Você deve selecionar pelo menos %s opções.',
        maxcheck: 'Você deve selecionar %s opções ou menos.',
        check: 'Você deve selecionar entre %s e %s escolhas.',
        equalto: 'Este valor deve ser o mesmo.',
      }
    )),
    'undefined' != typeof window.ParsleyValidator &&
      window.ParsleyValidator.addCatalog(
        'en',
        window.ParsleyConfig.i18n.en,
        !0
      );
  var t = a.extend(new h(), {
    $element: a(document),
    actualizeOptions: null,
    _resetOptions: null,
    Factory: p,
    version: '2.1.2',
  });
  a.extend(n.prototype, h.prototype),
    a.extend(l.prototype, h.prototype),
    a.extend(p.prototype, h.prototype),
    (a.fn.parsley = a.fn.psly =
      function (b) {
        if (this.length > 1) {
          var c = [];
          return (
            this.each(function () {
              c.push(a(this).parsley(b));
            }),
            c
          );
        }
        return a(this).length
          ? new p(this, b)
          : void f.warn('You must bind Parsley on an existing element.');
      }),
    'undefined' == typeof window.ParsleyExtend && (window.ParsleyExtend = {}),
    (t.options = a.extend(f.objectCreate(g), window.ParsleyConfig)),
    (window.ParsleyConfig = t.options),
    (window.Parsley = window.psly = t),
    (window.ParsleyUtils = f),
    (window.ParsleyValidator = new j(
      window.ParsleyConfig.validators,
      window.ParsleyConfig.i18n
    )),
    (window.ParsleyUI =
      'function' == typeof window.ParsleyConfig.ParsleyUI
        ? new window.ParsleyConfig.ParsleyUI().listen()
        : new k().listen()),
    !1 !== window.ParsleyConfig.autoBind &&
      a(function () {
        a('[data-parsley-validate]').length &&
          a('[data-parsley-validate]').parsley();
      });
});
