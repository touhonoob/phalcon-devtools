<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands\Builtin;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;

/**
 * Enumerate Command
 *
 * @package     Phalcon\Commands\Builtin
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Enumerate extends Command
{
    const COMMAND_COLUMN_LEN = 16;

    protected $_possibleParameters = array();

    /**
     * Executes the command
     *
     * @param $parameters
     * @return void
     */
    public function run($parameters)
    {
        print Color::colorize('Available commands:', Color::FG_BROWN) . PHP_EOL;
        foreach ($this->getScript()->getCommands() as $commands) {
            $providedCommands = $commands->getCommands();
            $commandLen = strlen($providedCommands[0]);

            print '  ' . Color::colorize($providedCommands[0], Color::FG_GREEN);
            unset($providedCommands[0]);
            if (count($providedCommands)) {
                $spacer = str_repeat(' ', self::COMMAND_COLUMN_LEN - $commandLen);
                print $spacer.' (alias of: ' . Color::colorize(join(', ', $providedCommands)) . ')';
            }
            print PHP_EOL;
        }
        print PHP_EOL;
    }

    /**
     * Returns the commands provided by the command
     *
     * @return array
     */
    public function getCommands()
    {
        return array('commands', 'list', 'enumerate');
    }

    /**
     * Checks whether the command can be executed outside a Phalcon project
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return true;
    }

    /**
     * Prints help on the usage of the command
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Lists the commands available in Phalcon devtools') . PHP_EOL . PHP_EOL;

        $this->run(array());
    }

    /**
     * Returns number of required parameters for this command
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
