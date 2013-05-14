<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
        
        echo $this->Html->css('font-awesome.min');

        echo $this->Html->script('jquery-1.9.1.min');
        
        echo $this->Html->script('jquery.tools.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    
    <div class="container">
        
        <header class="hero-unit">
            <h1>CakePHP Extended</h1>
            <p>CakePHP with additional features</p>
        </header>
    
        <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		
		
	   <footer>
    		<?php
                echo $this->Html->link(
                    $this->Html->image('cake.power.gif'),
                    'http://www.cakephp.org/',
    				array('target' => '_blank', 'escape' => false)
    			);
    		?>
    	</footer>
	
        <section class="sql-dump">
            <?php echo $this->element('sql_dump'); ?>
        </section>

    </div>
	
</body>
</html>
