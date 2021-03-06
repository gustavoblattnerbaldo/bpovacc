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
            '??' => 'i',    '??' => 'c',  '??' => 'u',  '??' => 'k',    '??' => 'e',
            '??' => 'n',    '??' => 'g',  '??' => 'sh', '??' => 'shch', '??' => 'z',
            '??' => 'h',    '??' => '',   '??' => 'f',  '??' => 'y',    '??' => 'v',
            '??' => 'a',    '??' => 'p',  '??' => 'r',  '??' => 'o',    '??' => 'l',
            '??' => 'd',    '??' => 'zh', '??' => 'e',  '??' => 'e',    '??' => 'ya',
            '??' => 'ch',   '??' => 's',  '??' => 'm',  '??' => 'i',    '??' => 't',
            '??' => '',     '??' => 'b',  '??' => 'yu', '??' => 'u',    '??' => 'k',
            '??' => 'g',    '??' => 'e',  '??' => 'n',  '??' => 'u',    '??' => 'o',
            '??' => 'h',    '??' => 'h',  '??' => 'i',  '??' => 'ji',   '??' => 'je',
            '??' => 'g',    '??' => 'I',  '??' => 'C',  '??' => 'U',    '??' => 'U',
            '??' => 'O',    '??' => 'K',  '??' => 'E',  '??' => 'N',    '??' => 'G',
            '??' => 'SH',   '??' => 'E',  '?? '=> 'N',  '??' => 'Z',    '??' => 'H',
            '??' => '',     '??' => 'F',  '??' => 'Y',  '??' => 'V',    '??' => 'A',
            '??' => 'P',    '??' => 'R',  '??' => 'O',  '??' => 'L',    '??' => 'D',
            '??' => 'ZH',   '??' => 'E',  '??' => 'E',  '??' => 'YA',   '??' => 'CH',
            '??' => 'S',    '??' => 'M',  '??' => 'I',  '??' => 'T',    '??' => '',
            '??' => 'B',    '??' => 'YU', '??' => 'U',  '??' => 'K',    '??' => 'G',
            '??' => 'SHCH', '??' => 'I',  '??' => 'YI', '??' => 'YE',   '??' => 'G',
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