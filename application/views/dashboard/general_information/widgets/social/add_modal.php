<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="addSocialModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addSocialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSocialModalLabel"><?php echo lang('BTN_ADD_SOCIAL_CHANNEL') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-8">
                            <div class="form-group">
                              <label for="inputNameSC" class="sr-only-rm"><?php echo lang('L_S_C_NAME');?></label>
                              <div id="inputNameSCError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                                </div>
                                <input type="text" id="inputNameSC" class="form-control" placeholder="<?php echo lang('L_S_C_NAME');?>" required>
                              </div>
                              <div id="inputNameSCErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputOrderingSC" class="sr-only-rm"><?php echo lang('L_S_C_ORDERING');?></label>
                              <div id="inputOrderingSCError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrderingSC" class="form-control" placeholder="<?php echo lang('L_S_C_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingSCErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputURLSC" class="sr-only-rm"><?php echo lang('L_S_C_URL');?></label>
                      <div id="inputURLSCError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe157;</i></div>
                        </div>
                        <input type="text" id="inputURLSC" class="form-control" placeholder="<?php echo lang('L_S_C_URL');?>" required>
                      </div>
                      <div id="inputURLSCErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIconSC" class="sr-only-rm"><?php echo lang('L_S_C_ICON');?></label>
                      <div id="inputIconSCError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolderSC" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIconSC', '#iconHolderSC')" id="inputIconSC" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_S_C_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconSCErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIconSC', '#iconHolderSC')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon-sc')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="add_social_channel" type="button" class="btn btn-primary" onclick="addSocialChannel()"><?php echo lang('BTN_ADD_SOCIAL_CHANNEL') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon-sc" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon-sc', null, 50, 50, .50, 'image/webp', setIconCbSCAdd, '#inputIconSC')"/>
</div>
