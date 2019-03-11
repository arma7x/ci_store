<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="updateSocialModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addSocialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSocialModalLabel"><?php echo lang('BTN_UPDATE_SOCIAL_CHANNEL') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="updateForm">
            <input type="hidden" id="inputIdSCEdit" class="sr-only-rm" required>
            <div class="row">
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputNameSCEdit" class="sr-only-rm"><?php echo lang('L_S_C_NAME');?></label>
                              <div id="inputNameSCEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                                </div>
                                <input type="text" id="inputNameSCEdit" class="form-control" placeholder="<?php echo lang('L_S_C_NAME');?>" required>
                              </div>
                              <div id="inputNameSCEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputOrderingSCEdit" class="sr-only-rm"><?php echo lang('L_S_C_ORDERING');?></label>
                              <div id="inputOrderingSCEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrderingSCEdit" class="form-control" placeholder="<?php echo lang('L_S_C_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingSCEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputURLSCEdit" class="sr-only-rm"><?php echo lang('L_S_C_URL');?></label>
                      <div id="inputURLSCEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe157;</i></div>
                        </div>
                        <input type="text" id="inputURLSCEdit" class="form-control" placeholder="<?php echo lang('L_S_C_URL');?>" required>
                      </div>
                      <div id="inputURLSCEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIconSCEdit" class="sr-only-rm"><?php echo lang('L_S_C_ICON');?></label>
                      <div id="inputIconSCEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolderSCEdit" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIconSCEdit', '#iconHolderSCEdit')" id="inputIconSCEdit" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_S_C_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconSCEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIconSCEdit', '#iconHolderSCEdit')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon-sc-edit')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="update_social_channel" type="button" class="btn btn-primary" onclick="updateSocialChannel()"><?php echo lang('BTN_UPDATE_SOCIAL_CHANNEL') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon-sc-edit" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon-sc-edit', null, 50, 50, .50, 'image/webp', setIconCbSCEdit, '#inputIconSCEdit')"/>
</div>
