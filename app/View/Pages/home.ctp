<?php

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>

<div class="row">
    <div class="span12">
        
        <h2>Status of your application</h2>
        
        <?php if(version_compare(PHP_VERSION, '5.2.8', '>=')): ?>
            <p class="alert alert-success">
                Your version of PHP is 5.2.8 or higher.
            </p>
        <?php else: ?>
            <p class="alert alert-error">
                Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.
            </p>
        <?php endif; ?>
        
        <?php if(Configure::read('debug') > 0): ?>
            <?php if(Configure::read('Security.salt') === 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi'): ?>
                <p class="alert alert-error">
                    Please change the value of <strong>Security.salt</strong> in <strong>app/Config/core.php</strong> to a salt value specific to your application.
                </p>
            <?php endif; ?>
            <?php if(Configure::read('Security.cipherSeed') === '76859309657453542496749683645'): ?>
                <p class="alert alert-error">
                    Please change the value of <strong>Security.cipherSeed</strong> in <strong>app/Config/core.php</strong> to a salt value specific to your application.
                </p>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if (is_writable(TMP)): ?>
            <p class="alert alert-success">
                Your tmp directory is writable.
            </p>
        <?php else: ?>
            <p class="alert alert-error">
                Your tmp directory is <strong>NOT</strong> writable.
            </p>
        <?php endif; ?>
        
        <?php
            $settings = Cache::settings();
            if (!empty($settings)):
        ?>
            <div class="alert alert-success">
                <?php echo __d('cake_dev', 'The %s is being used for core caching. To change the config edit APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>'); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-error">
                Your cache is <strong>NOT</strong> working. Please check the settings in APP/Config/core.php;
            </div>
        <?php endif; ?>
        
        <?php
            $filePresent = null;
            if (file_exists(APP . 'Config' . DS . 'database.php')):
                echo '<p class="alert alert-success">';
                    echo __d('cake_dev', 'Your database configuration file is present.');
                    $filePresent = true;
                echo '</p>';
            else:
                echo '<p class="alert alert-error">';
                    echo __d('cake_dev', 'Your database configuration file is NOT present.');
                    echo '<br/>';
                    echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
                echo '</p>';
            endif;
        ?>
        
        <?php
            if ($filePresent !== null):
                
                App::uses('ConnectionManager', 'Model');
                try {
                    $connected = ConnectionManager::getDataSource('default');
                } catch (Exception $connectionError) {
                    $connected = false;
                    $errorMsg = $connectionError->getMessage();
                    if (method_exists($connectionError, 'getAttributes')) {
                        $attributes = $connectionError->getAttributes();
                        if (isset($errorMsg['message'])) {
                            $errorMsg .= '<br />' . $attributes['message'];
                        }
                    }
                }
                if ($connected && $connected->isConnected()):
                    echo '<p class="alert alert-success">';
                        echo __d('cake_dev', 'Cake is able to connect to the database.');
                    echo '</p>';
                else:
                    echo '<p class="alert alert-error">';
                        echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
                        echo '<br /><br />';
                        echo $errorMsg;
                    echo '</p>';
                endif;
            endif;
        ?>
        
        <?php
            App::uses('Validation', 'Utility');
            if (!Validation::alphaNumeric('cakephp')) {
                echo '<p class="alert alert-error">';
                    echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
                    echo '<br/>';
                    echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
                echo '</p>';
            }
        ?>
        
    </div>
</div>

<div class="row">
    
    <div class="span6">
        <h2>Versions</h2>
        <table class="table">
            <colgroup>
                <col />
                <col width="150" />
            </colgroup>
            <tbody>
                <tr>
                    <td>CakePHP</td>
                    <td class="text-right"><?php echo Configure::version(); ?></td>
                </tr>
                <tr>
                    <td>jQuery</td>
                    <td class="text-right">1.9.1</td>
                </tr>
                <tr>
                    <td>FontAwesome</td>
                    <td class="text-right">3.1.1</td>
                </tr>
                <tr>
                    <td>Twitter Bootstrap</td>
                    <td class="text-right">2.3.1</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="span6">
        <h2>Additional links</h2>
        <ul>
            <li><a href="http://cakephp.org/changelogs/<?php echo Configure::version(); ?>"><?php echo __d('cake_dev', 'CakePHP ' . Configure::version() . ' changelog'); ?> </a></li>
            <li><?php
                echo $this->Html->link(
                    sprintf('<strong>%s</strong> %s', __d('cake_dev', 'New'), __d('cake_dev', 'CakePHP 2.0 Docs')),
                    'http://book.cakephp.org/2.0/en/',
                    array('target' => '_blank', 'escape' => false)
                );
            ?></li>
            <li><?php
                echo $this->Html->link(
                    __d('cake_dev', 'The 15 min Blog Tutorial'),
                    'http://book.cakephp.org/2.0/en/tutorials-and-examples/blog/blog.html',
                    array('target' => '_blank', 'escape' => false)
                );
            ?></li>
            <li><a href="http://cakefoundation.org/"><?php echo __d('cake_dev', 'Cake Software Foundation'); ?></a></li>
            <li><a href="http://www.cakephp.org"><?php echo __d('cake_dev', 'CakePHP'); ?></a></li>
            <li><a href="http://book.cakephp.org"><?php echo __d('cake_dev', 'CakePHP Documentation'); ?></a></li>
            <li><a href="http://api.cakephp.org/"><?php echo __d('cake_dev', 'CakePHP API'); ?></a></li>
            <li><a href="http://bakery.cakephp.org"><?php echo __d('cake_dev', 'The Bakery'); ?></a></li>
            <li><a href="http://plugins.cakephp.org"><?php echo __d('cake_dev', 'CakePHP plugins repo'); ?></a></li>
            <li><a href="http://groups.google.com/group/cake-php"><?php echo __d('cake_dev', 'CakePHP Google Group'); ?></a></li>
            <li><a href="irc://irc.freenode.net/cakephp">irc.freenode.net #cakephp</a></li>
            <li><a href="http://github.com/cakephp/"><?php echo __d('cake_dev', 'CakePHP Code'); ?></a></li>
            <li><a href="http://cakephp.lighthouseapp.com/"><?php echo __d('cake_dev', 'CakePHP Lighthouse'); ?></a></li>
        </ul>
    </div>
    
</div>



