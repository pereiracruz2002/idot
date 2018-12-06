<?php if(!$this->input->is_ajax_request()) include_once(dirname(__FILE__).'/../header.php'); ?>
<?php 
  if(method_exists($c, '_filter_pre_visualizar'))
    $c->_call_filter_pre_visualizar($item, $models);
?>
  <div class="col-sm-12">
    <h1 class="header smaller lighter blue"><?php echo ucfirst($titulo)?></h1>
  
    <div class="tabbable">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue hidden-xs" id="myTab4">
      	<?php $i=0; foreach($models as $model => $titulo_model): ?>
        	<?php if($titulo_model['titulo']): $i++; ?>
        	    <li class="<?php echo ($i==1)? "active":"" ?>">
                    <a data-toggle="tab" href="#tabs-<?php echo $i ?>"><?php echo $titulo_model['titulo'] ?></a>
                </li>
        	<?php endif; ?>
      	<?php endforeach; ?>
  	</ul>
	<select class="container-mobile-tab nav-tabs background-blue form-control visible-xs" id="myTab4">
		<?php $i=0; foreach($models as $model => $titulo_model): ?>
        	<?php if($titulo_model['titulo']): $i++; ?>
        		<option value="#tabs-<?php echo $i ?>"><?php echo $titulo_model['titulo'] ?></option>
        	<?php endif; ?>
      	<?php endforeach; ?>
	</select>
    <div class="tab-content">
      	<?php $e=0; foreach($models as $model => $titulo_model): ?>
          	<?php if($titulo_model['titulo']): $e++; ?>
          	    <div id="tabs-<?php echo $e; ?>" class="tab-pane in <?php echo ($e==1)? "active":"" ?>">
          	<?php endif; ?>
  	    <?php if($titulo_model['titulo']): $i=0; ?>
  	
  	        <?php if(isset($titulo_model['has_many'])): ?>

    <?php foreach($item as $it): ?>
  	<table class="documentation">
		<?php foreach($this->{$model}->fields as $k => $v): ?>
			<tr>
  			<th><?php echo $v['label'] ?></th>
  			<td>
  			<?php if(strstr($v['class'], 'imagem')): ?>
  			<?php if($item[$i]->{$k}): ?>
  			<img src="<?php echo image_url($item[$i]->{$k}) ?>" width="180" />
  			<?php endif; ?>
  			 
  			<?php elseif(strstr($v['class'], 'valor')): ?>
  			R$ <?php echo formata_valor($item[$i]->{$k}) ?>
  			<?php elseif(strstr($v['class'], 'time')): ?>
  			<?php echo formata_time($item[$i]->{$k}) ?>
  			<?php elseif(strstr($v['class'], 'data')): ?>
  			<?php echo formata_data($item[$i]->{$k}) ?>
  			<?php elseif(isset($v['from'])): ?>
  			<?php echo get_from($v['from'], $item[$i]->{$k}) ?>
  			<?php elseif(isset($v['serialized'])): ?>
  			
  			  <?php $arrSerial = unserialize($item[$i]->{$k}) ?>
  			  <?php foreach($arrSerial as $sK => $sV): ?>
  			  <p><?php echo is_int($sK) ? '' : $sK.': ' ?> <?php echo $sV ?></p>
  			  <?php endforeach; ?>
  			
  			<?php else: ?>
  			<?php echo $item[$i]->{$k} ?>
  			<?php endif; ?>
  			
  			
  		<?php endforeach; ?>
			</td>
			</tr>
  	</table>
    <?php $i++; endforeach; ?>
  	
  	<?php else: ?>
  	<div class="profile-user-info profile-user-info-striped">
		<?php foreach($this->{$c->modelname}->fields as $k => $v): ?>
		  <div class="profile-info-row">
		  
			<div class="profile-info-name"><?php echo $v['label'] ?></div>
			<div class="profile-info-value">
                <span class="editable editable-click">
    			    <?php if(strstr($v['class'], 'imagem')): ?>
        			<img src="<?php echo base_url() ?>uploads/<?php echo $item[$i]->{$k} ?>" />
        			<?php elseif(strstr($v['class'], 'valor')): ?>
        			<?php echo ( gettype($item[$i]->{$k}) == "integer" || gettype($item[$i]->{$k}) =="double")? 
                       "R$ ". formata_valor($item[$i]->{$k}) : $item[$i]->{$k}?>
        			<?php elseif(strstr($v['class'], 'time')): ?>
        			<?php echo formata_time($item[$i]->{$k}) ?>
        			<?php elseif(strstr($v['class'], 'data')): ?>
        			<?php echo formata_data($item[$i]->{$k}) ?>
        			<?php elseif(isset($v['from'])): ?>
        			<?php echo get_from($v['from'], $item[$i]->{$k}) ?>
        			<?php else: ?>
        			<?php print_r($item[$i]->{$k} )?>
        			<?php endif; ?>
                </span>
			</div>	
		</div>
		<?php endforeach; ?>
  	</div>
  	<?php endif; ?>
  	
  	<?php endif; ?> 
    	<?php if($titulo_model['titulo']): ?>
    	</div> <!-- tab-<?php echo $e; ?> -->
    	<?php endif; ?>
  	<?php endforeach; ?>
    </div>
        <hr>
  </div>
  <?php  
    if(method_exists($c, '_pos_visualizar'))
      $c->_pos_visualizar($item);
    ?>
  
<?php if(!$this->input->is_ajax_request()) include_once(dirname(__FILE__).'/../footer.php'); ?>
