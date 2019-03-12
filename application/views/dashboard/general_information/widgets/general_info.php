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
              <label for="inputEmailAddress" class="sr-only-rm"><?php echo lang('L_EMAIL');?>(<?php echo lang('H_G_INBOX_CHANNEL') ;?>)</label>
              <div id="inputEmailAddressError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe0be;</i></div>
                </div>
                <input type="email" id="inputEmailAddress" value="<?php echo isset($gi_item['email']) ? $gi_item['email'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_EMAIL');?>" required>
              </div>
              <div id="inputEmailAddressErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group">
              <label for="inputOfficeNumber" class="sr-only-rm"><?php echo lang('L_G_OFFICE_NUMBER');?>(<?php echo lang('H_G_INBOX_CHANNEL') ;?>)</label>
              <div id="inputOfficeNumberError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe0b0;</i></span>
                </div>
                <input type="tel" id="inputOfficeNumber" value="<?php echo isset($gi_item['office_number']) ? $gi_item['office_number'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_G_OFFICE_NUMBER');?>" required>
              </div>
              <div id="inputOfficeNumberErrorText" class="form-control-feedback text-danger"></div>
            </div>
            
            <div class="form-group">
              <label for="inputMobileNumber" class="sr-only-rm"><?php echo lang('L_G_MOBILE_NUMBER');?>(<?php echo lang('H_G_INBOX_CHANNEL') ;?>)</label>
              <div id="inputMobileNumberError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe32c;</i></div>
                </div>
                <input type="tel" id="inputMobileNumber" value="<?php echo isset($gi_item['mobile_number']) ? $gi_item['mobile_number'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_G_MOBILE_NUMBER');?>" required>
              </div>
              <div id="inputMobileNumberErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group">
              <label for="inputCurrencyUnit" class="sr-only-rm"><?php echo lang('L_G_CURRENCY_UNIT');?></label>
              <div id="inputCurrencyUnitError" class="input-group border rounded">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="material-icons">&#xe227;</i></div>
                </div>
                <input type="text" id="inputCurrencyUnit" value="<?php echo isset($gi_item['currency_unit']) ? $gi_item['currency_unit'] : '' ?>" class="form-control" placeholder="<?php echo lang('L_G_CURRENCY_UNIT');?>" required>
              </div>
              <div id="inputCurrencyUnitErrorText" class="form-control-feedback text-danger"></div>
            </div>

        </div>
        <div class="col col-12 col-sm-6">
            
            <div class="form-group">
              <label for="inputDescription" class="sr-only-rm">
                <?php echo lang('L_G_DESCRIPTION');?>
                <small><span id="inputDescriptionLength"><?php echo isset($gi_item['description']) ? strlen($gi_item['description']) : '0' ?></span>/160</small>
              </label>
              <div id="inputDescriptionError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe873;</i></span>
                </div>
                <textarea rows="5" type="text" id="inputDescription" class="form-control" placeholder="<?php echo lang('L_G_DESCRIPTION');?>" onInput="checkLength('#inputDescription', '#inputDescriptionLength')" maxlength="160" required><?php echo isset($gi_item['description']) ? $gi_item['description'] : '' ?></textarea>
              </div>
              <div id="inputDescriptionErrorText" class="form-control-feedback text-danger"></div>
            </div>
            
            <div class="form-group">
              <label for="inputAddress" class="sr-only-rm"><?php echo lang('L_G_ADDRESS');?> & <?php echo lang('L_G_WORKING_HOUR');?></label>
              <div id="inputAddressError" class="input-group border rounded">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons">&#xe52e;</i></span>
                </div>
                <textarea rows="5" type="text" id="inputAddress" class="form-control" placeholder="<?php echo lang('L_G_ADDRESS');?>" required><?php echo isset($gi_item['address']) ? $gi_item['address'] : '' ?></textarea>
              </div>
              <div id="inputAddressErrorText" class="form-control-feedback text-danger"></div>
            </div>

            <div class="form-group">
                <button id="update_general_information" onclick="updateGeneralInformation()" class="btn btn-primary btn-block" type="submit"><?php echo lang('BTN_UPDATE_G_INFORMATION');?></button>
            </div>
        </div>
    </div>
  </form>
</div>
