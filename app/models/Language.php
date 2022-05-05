<?php

class Language extends Eloquent {

	public $timestamps 	= false;
	private $storeFile	= 'dinamic';
	
	
	public function defaultLanguage()
	{
		$query = DB::table('users')
				->join('languages', 'languages.id', '=', 'users.language_id')
				->select('languages.id', 'languages.name', 'languages.short')
				->where('users.id', Auth::id() ? Auth::id() : 1)
				->first();
				
		return isset($query) ? $query : 'en';
	}	
	
	public function createLanguageFile($value)
	{
		$oldData = File::getRequire(base_path().'/app/lang/_default/' . $this->storeFile . '.php');
		
		$newData = array_merge(
			$oldData, 
			array(
				self::translateSlug($value, '_') => trim($value)
			)
		);
		
		$this->storeDataInFile($newData);
		$this->translateLanguage(false, 1);
	}
	
	public function updateLanguageFile($old, $new)
	{
		$this->deleteFromLanguageFile($old);	
		$this->createLanguageFile($new);	
	}
	
	public function deleteFromLanguageFile($value)
	{
		$data = File::getRequire(base_path().'/app/lang/_default/' . $this->storeFile . '.php');
		$word = self::translateSlug($value, '_');
		unset($data[$word]);

		$this->storeDataInFile($data);
		$this->translateLanguage(false, 1);
	}
	
	public function storeDataInFile($data)
	{
		$contents = "
		<?php
		return array(\n";
		
		foreach ($data as $k => $v)
		{
			$contents .= '"' . $k . '" => "' . trim($v) . '", ';
		}
	
		$contents .= "\n);";
		
		File::put( app_path() . '/lang/_default/'. $this->storeFile .'.php', $contents);		
	}
	
	public function translateLanguage($words, $languageID)
	{
		if (!$words)
		{
			$words = array_merge(File::getRequire(base_path().'/app/lang/_default/default.php'), File::getRequire(base_path().'/app/lang/_default/dinamic.php'));
		}

		$contents = "
		<?php
		return array(";
		
		foreach ($words as $k => $v)
		{
			$contents .= '"' . $k . '" => "' . trim($v) . '", ';
		}
	
		$contents .= ");";
		
		File::put( app_path() . '/lang/' . Language::where('id', $languageID)->first()->short . '/translate.php', $contents);		
	}
	
    public static function translateSlug($str, $separator)
    {
        $matrix = [
            'й' => 'i',    'ц' => 'c',  'у' => 'u',  'к' => 'k',    'е' => 'e',
            'н' => 'n',    'г' => 'g',  'ш' => 'sh', 'щ' => 'shch', 'з' => 'z',
            'х' => 'h',    'ъ' => '',   'ф' => 'f',  'ы' => 'y',    'в' => 'v',
            'а' => 'a',    'п' => 'p',  'р' => 'r',  'о' => 'o',    'л' => 'l',
            'д' => 'd',    'ж' => 'zh', 'э' => 'e',  'ё' => 'e',    'я' => 'ya',
            'ч' => 'ch',   'с' => 's',  'м' => 'm',  'и' => 'i',    'т' => 't',
            'ь' => '',     'б' => 'b',  'ю' => 'yu', 'ү' => 'u',    'қ' => 'k',
            'ғ' => 'g',    'ә' => 'e',  'ң' => 'n',  'ұ' => 'u',    'ө' => 'o',
            'Һ' => 'h',    'һ' => 'h',  'і' => 'i',  'ї' => 'ji',   'є' => 'je',
            'ґ' => 'g',    'Й' => 'I',  'Ц' => 'C',  'У' => 'U',    'Ұ' => 'U',
            'Ө' => 'O',    'К' => 'K',  'Е' => 'E',  'Н' => 'N',    'Г' => 'G',
            'Ш' => 'SH',   'Ә' => 'E',  'Ң '=> 'N',  'З' => 'Z',    'Х' => 'H',
            'Ъ' => '',     'Ф' => 'F',  'Ы' => 'Y',  'В' => 'V',    'А' => 'A',
            'П' => 'P',    'Р' => 'R',  'О' => 'O',  'Л' => 'L',    'Д' => 'D',
            'Ж' => 'ZH',   'Э' => 'E',  'Ё' => 'E',  'Я' => 'YA',   'Ч' => 'CH',
            'С' => 'S',    'М' => 'M',  'И' => 'I',  'Т' => 'T',    'Ь' => '',
            'Б' => 'B',    'Ю' => 'YU', 'Ү' => 'U',  'Қ' => 'K',    'Ғ' => 'G',
            'Щ' => 'SHCH', 'І' => 'I',  'Ї' => 'YI', 'Є' => 'YE',   'Ґ' => 'G',
        ];

        foreach ($matrix as $from => $to)  {
            $str = mb_eregi_replace($from, $to, $str);
        }

        $pattern 	= '![^'.preg_quote($separator).'\pL\pN\s]+!u';
        $str 		= preg_replace($pattern, '', mb_strtolower($str));
        $flip 		= $separator == '-' ? '_' : '-';
        $str 		= preg_replace('!['.preg_quote($flip).']+!u', $separator, $str);
        $str 		= preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $str);
	
		return Str::slug($str, $separator);
    }
	
}