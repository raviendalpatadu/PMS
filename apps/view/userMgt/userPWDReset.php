<?php
require_once '../../control/config.php';
$template = new template();

?>

<div class="container-fluid">
    <hr>
    <div class="row-fluid"> Password Reset
        <div class="span12">
            <div class="widget-box">
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">user_fname</label>
                                <div class="controls">
                                    <input type="text" name="required" id="user_fname" name="user_fname" required="">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">user_lname</label>
                                <div class="controls">
                                    <input type="text" name="required" id="user_lname" name="user_lname">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">user_moblie</label>
                                <div class="controls">
                                    <input type="text" name="required" id="user_moblie" name="user_moblie">
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">user_address</label>
                                <div class="controls">
                                    <input type="text" name="required" id="user_address" name="user_address">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">user_email</label>
                                <div class="controls">
                                    <input type="text" name="required" id="user_email" name="user_email">
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="submit" value="Validate" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>