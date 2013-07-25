
<img src="http://s-group.in.ua/yalta/public/img/logo1.png" width="130" height="115" alt="Ялта"><br/>
Исходник проекта сайта-путеводителя http://crimea-guide.in.ua/public/.
Проект находится на стадии разработки.В ближайшем времени проект будет запущен и протестирован.<br/>
Структура проекта:<br/>
Проект использует PHP - фреймворк:Zend Framework v2.0 (http://www.framework.zend.com). <br/>
Фреймворк состоит со следующих модулей:<br/>
<ul>
    <li>Текущие(разработанные на данный  момент)</li>
      <ul>
         <li>Статические:<br/></li> 
          <ul>
               <li> <a href="https://github.com/alfared/yalta/tree/master/module/Application">Application</a>  - самый главный модуль проекта.Отвечает за 
        инициализацию всех модулей.</li>
               <li> <a href="https://github.com/alfared/yalta/tree/master/module/Attraction">Attraction</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех достопримечатеностей города Ялта(Будет изменен и доработан).
              </li>
               <li> <a href="https://github.com/alfared/yalta/tree/master/module/Cafe">Cafe</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех кафе города Ялта(Будет изменен и доработан).
              </li>
              <li> <a href="https://github.com/alfared/yalta/tree/master/module/Club">Club</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех клубов города Ялта(Будет изменен и доработан).
              </li>
              <li> <a href="https://github.com/alfared/yalta/tree/master/module/Hostel">Hostel</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех гостиниц города Ялта(Будет изменен и доработан).
              </li>
              <li> <a href="https://github.com/alfared/yalta/tree/master/module/Restaurant">Restaurant</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех ресторанов города Ялта(Будет изменен и доработан).
               </li>
              <li> <a href="https://github.com/alfared/yalta/tree/master/module/Timetable">Timetable</a> - cтатический модуль проекта.Отвечает за добавление(в админ.панели),удаление(в админ.панели),вывод всех расписаний городского транспорта города Ялта(Будет изменен и доработан).
               </li>
         </ul>
         
            <li>Готовые:<br/></li> 
             <ul>
                <li><a href="https://github.com/gowsram/zf2-google-maps-">zf2-google-maps</a> - модуль проекта.Отвечает за синхронизацию проекта с сервисом <a href="https://developers.google.com/maps/">Google Maps API</a>
                      </li>
                <li><a href="https://github.com/ZF-Commons">ZF-Commons</a></li>
                <ul>                     
                      <li><a href="https://github.com/ZF-Commons/ZfcBase">ZfcBase</a> - набор абстрактный классов которые используются через множество модулей,которые могут быть связанные</a>
                      </li>
                      <li><a href="https://github.com/ZF-Commons/ZfcUser">ZfcUser</a> - модуль для работы с пользователями.Использует сервисы аутентификации,регистрации,логина пользователя</a>
                      </li>
                      <li><a href="https://github.com/ZF-Commons/ZfcAdmin">ZfcAdmin</a> - модуль для работы с админской панелю сайта./a>
                      </li>
                       
                </ul>
               
             </ul>                  
       </ul>
       <li>Будущие(будут разработаны через некоторое время)</li>
       <ul>
        <li>Готовые:</li>
          <ul>
            <li><a href="https://github.com/ZF-Commons/ZfcRbac">ZfcRbac</a> - модуль основан на управление ролями при доступе к некоторым модулям</li>
             <li><a href="https://github.com/bjyoungblood/BjyAuthorize">BjyAuthorize</a> - модуль основан на <code>Zend\Permissions\Acl</code> компоненте ZF2 который позволяет нам повысить процент защиты от изменений в струкутрах статических модулей. </li>
          <li><a href="https://github.com/EvanDotPro/EdpCommon">EdpCommon</a> - модуль который содержит набор классов для работы с ZF2-commons модулями</a>
                      </li>
         </ul>
       </ul>

</ul>
