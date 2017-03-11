<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadHelper('WyriHaximus/MinifyHtml.MinifyHtml');
        $this->loadHelper('File');
        echo <<< EOF
<!--
      ________________________
     <                        >
     <     BIENVENUE SUR      <_
     >                        |\\       )       /\
     <       GOMINES !       |@\\     \|/    _//@|
     >                        |@@\\_--------_/_/@|
     <_______            _____>\@/~ ___   __ -\@@|
      ~~~~~~~~~~~~~\##\~~~~~~~  /  / _     _\  \~
                    \##\       /    / \   / \   \
                     \##\     /    /   | |   \   \
                      \##\___/_____\ _0|_|0  _|___\____
                   ,-----'    __   \/      \/  ___     `-----,_
                  /______    /   __ |      | __   \          __\
                  ____/     / \ /   \______/   \ / \    __/\/
                 /  _____      :       /\       :         \_
                /__/   __/      \ ____/  \_____/      ____  \
                    __/  ___________   ~~   ________  \   \  |
                   / ___/  \##\     )      (        \__\   \/
                  /_/       \##\    |      |
                             \##\___|      |_____
                         _____\##\ /@@@@@@@\     \_
                       _/      \##\@@@@@@@@@\      \
                      /         \##\@@@@@@@@@: \    \
                     /    _/     \##\@@@@@@@@:  \    \
                    |   _/____   /~~~~) @@@@@:   |    |
                    |    ~    `--: ~~~) @@@@@:   |    |
                     \________,--(_~~~)   @@@:  /    /
                              :  : (~~~~~| @@:_/    /
        _______               :  : (~~~  |--`      /
       <@@@@@@@\_             :  : (~~~___--,_____/
            \@@@ \            :  :@ ~~~\##\ @:  :
              \   \_          /  :@@@@@@\##\@:   \
               \    \_______ /   :@@@@@@@~~~@:    :
                \_          :    :@@@@@@@@@@@/    :
                  \_________:     \@@@@@@@@@/     :
                            :      \@@@@@@@/      :
                            :     _/       \_     :
                           /    _/           \_    \
                         _:-^- /               \_--^\ __
                       _/     |                  \     __)
                      (__:_:__:                   (_______)
-->\n
EOF;
    }
}
