<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="mt-3">
  <form>
    <div class="row">
        <div class="col col-12 col-sm-6">
            <div class="form-group">
              <label for="inputName" class="sr-only-rm"><?php echo lang('L_G_NAME');?></label>
              <div id="inputNameError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe8d1;</i></span>
                </div>
                <input type="text" id="inputName" class="form-control" value="<?php echo isset($gi_item['name']) ? $gi_item['name'] : '' ?>" placeholder="<?php echo lang('L_G_NAME');?>" required>
              </div>
              <div id="inputNameErrorText" class="form-control-feedback text-danger"></div>
            </div>
            <div class="form-group">
              <label for="inputEmailAddress" class="sr-only-rm"><?php echo lang('L_EMAIL');?></label>
              <div id="inputEmailAddressError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe0be;</i></div>
                </div>
                <input type="email" id="inputEmailAddress" value="<?php echo isset($gi_item['email']) ? $gi_item['email'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_EMAIL');?>" required>
              </div>
              <div id="inputEmailAddressErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group">
              <label for="inputOfficeNumber" class="sr-only-rm"><?php echo lang('L_G_OFFICE_NUMBER');?></label>
              <div id="inputOfficeNumberError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe0b0;</i></span>
                </div>
                <input type="tel" id="inputOfficeNumber" value="<?php echo isset($gi_item['office_number']) ? $gi_item['office_number'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_G_OFFICE_NUMBER');?>" required>
              </div>
              <div id="inputOfficeNumberErrorText" class="form-control-feedback text-danger"></div>
            </div>
            
            <div class="form-group">
              <label for="inputMobileNumber" class="sr-only-rm"><?php echo lang('L_G_MOBILE_NUMBER');?></label>
              <div id="inputMobileNumberError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe32c;</i></div>
                </div>
                <input type="tel" id="inputMobileNumber" value="<?php echo isset($gi_item['mobile_number']) ? $gi_item['mobile_number'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_G_MOBILE_NUMBER');?>" required>
              </div>
              <div id="inputMobileNumberErrorText" class="form-control-feedback text-danger"></div>
            </div>

        </div>
        <div class="col col-12 col-sm-6">
            
            <div class="form-group">
              <label for="inputDescription" class="sr-only-rm"><?php echo lang('L_G_DESCRIPTION');?></label>
              <div id="inputDescriptionError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe873;</i></span>
                </div>
                <textarea rows="3" type="text" id="inputDescription" class="form-control" placeholder="<?php echo lang('L_G_DESCRIPTION');?>" required><?php echo isset($gi_item['description']) ? $gi_item['description'] : '' ?></textarea>
              </div>
              <div id="inputDescriptionErrorText" class="form-control-feedback text-danger"></div>
            </div>
            
            <div class="form-group">
              <label for="inputAddress" class="sr-only-rm"><?php echo lang('L_G_ADDRESS');?> & <?php echo lang('L_G_WORKING_HOUR');?></label>
              <div id="inputAddressError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe52e;</i></span>
                </div>
                <textarea rows="4" type="text" id="inputAddress" class="form-control" placeholder="<?php echo lang('L_G_ADDRESS');?>" required><?php echo isset($gi_item['address']) ? $gi_item['address'] : '' ?></textarea>
              </div>
              <div id="inputAddressErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group sr-only">
              <label for="inputWorkingHours" class="sr-only-rm"><?php echo lang('L_G_WORKING_HOUR');?></label>
              <div id="inputWorkingHoursError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe8b5;</i></div>
                </div>
                <textarea rows="2" type="text" id="inputWorkingHours" class="form-control" placeholder="<?php echo lang('L_G_WORKING_HOUR');?>" required><?php echo isset($gi_item['working_hours']) ? $gi_item['working_hours'] : '' ?></textarea>
              </div>
              <div id="inputWorkingHoursErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group">
                <button id="update_general_information" onclick="updateGeneralInformation()" class="btn btn-primary btn-block" type="submit"><?php echo lang('BTN_UPDATE_G_INFORMATION');?></button>
            </div>
        </div>
    </div>
  </form>
</div>
