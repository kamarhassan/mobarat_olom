
<div class="col-md-6 col-sm-6 p2">
                <div class="content">
                    <!-- BEGIN LOGIN FORM -->
                    <h3 >Enter email please</h3>
                    <div >
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'forguet-Mail',// 'forguet',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        
                        <div >
                            <i ></i>
                            
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control placeholder-no-fix', 'placeholder' => "email")); ?>
                             <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>
                   <div ></div >
                   <div >

                       <p></p>
                        <button type="submit" >
                            send <i ></i>
                        </button>
                    </div>
                    <div>
                    	<p><?php echo $model->result;?></p>
                    </div>
<?php $this->endWidget(); ?>
</div>
</div>
                    
                      
                    

