<?
#################################################
#        Company developer: ALTASIB
#        Developer: Evgeniy Pedan
#        Site: http://www.altasib.ru
#        E-mail: dev@altasib.ru
#        Copyright (c) 2006-2016 ALTASIB
#################################################
?>
<?
namespace ALTASIB\Support;

use Bitrix\Main;
class UserTable extends \Bitrix\Main\UserTable
{
    public static function getMap()
    {
		$connection = Main\Application::getConnection();
		$helper = $connection->getSqlHelper();
        
        $map = parent::getMap();
        
        $map['SHORT_NAME'] =array(
				'data_type' => 'string',
				'expression' => array(
					'CASE WHEN length(%s)>0 THEN '.$helper->getConcatFunction("%s","' '", "%s").' ELSE %s END',
					'NAME','NAME','LAST_NAME','LOGIN'
				)
        );        

        $map['LIST_NAME'] =array(
				'data_type' => 'string',
				'expression' => array(
					$helper->getConcatFunction("'('","%s","') '","%s","' '", "%s"),
					'LOGIN','LAST_NAME', 'NAME'
				)
        );                
        return $map;
    }
}

?>