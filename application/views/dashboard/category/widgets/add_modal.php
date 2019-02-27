<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="addInboxModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addInboxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInboxModalLabel"><?php echo lang('BTN_ADD_CATEGORY') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputName" class="sr-only-rm"><?php echo lang('L_CAT_NAME');?></label>
                      <div id="inputNameError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                        </div>
                        <input type="text" id="inputName" class="form-control" placeholder="<?php echo lang('L_CAT_NAME');?>" required>
                      </div>
                      <div id="inputNameErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputOrdering" class="sr-only-rm"><?php echo lang('L_CAT_ORDERING');?></label>
                      <div id="inputOrderingError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                        </div>
                        <input type="number" id="inputOrdering" class="form-control" placeholder="<?php echo lang('L_CAT_ORDERING');?>" required>
                      </div>
                      <div id="inputOrderingErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIcon" class="sr-only-rm"><?php echo lang('L_CAT_ICON');?></label>
                      <div id="inputIconError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolder" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIcon', '#iconHolder')" id="inputIcon" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_CAT_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIcon', '#iconHolder')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="add_category" type="button" class="btn btn-primary" onclick="addCategory()"><?php echo lang('BTN_ADD_CATEGORY') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon', null, 50, 50, .50, 'image/webp', setIconCbAdd, '#inputIcon')"/>
</div>
