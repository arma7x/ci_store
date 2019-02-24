<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="updateInboxModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addInboxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInboxModalLabel"><?php echo lang('BTN_UPDATE_INBOX_CHANNEL') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="updateForm">
            <input type="hidden" id="inputIdICEdit" class="sr-only-rm" required>
            <div class="row">
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-8">
                            <div class="form-group">
                              <label for="inputNameICEdit" class="sr-only-rm"><?php echo lang('L_S_C_NAME');?></label>
                              <div id="inputNameICEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                                </div>
                                <input type="text" id="inputNameICEdit" class="form-control" placeholder="<?php echo lang('L_S_C_NAME');?>" required>
                              </div>
                              <div id="inputNameICEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputOrderingICEdit" class="sr-only-rm"><?php echo lang('L_S_C_ORDERING');?></label>
                              <div id="inputOrderingICEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrderingICEdit" class="form-control" placeholder="<?php echo lang('L_S_C_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingICEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputURLICEdit" class="sr-only-rm"><?php echo lang('L_S_C_URL');?></label>
                      <div id="inputURLICEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe157;</i></div>
                        </div>
                        <input type="text" id="inputURLICEdit" class="form-control" placeholder="<?php echo lang('L_S_C_URL');?>" required>
                      </div>
                      <div id="inputURLICEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIconICEdit" class="sr-only-rm"><?php echo lang('L_S_C_ICON');?></label>
                      <div id="inputIconICEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolderICEdit" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIconICEdit', '#iconHolderICEdit')" id="inputIconICEdit" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_S_C_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconICEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIconICEdit', '#iconHolderICEdit')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon-ic-edit')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="update_inbox_channel" type="button" class="btn btn-primary" onclick="updateInboxChannel()"><?php echo lang('BTN_UPDATE_INBOX_CHANNEL') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon-ic-edit" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon-ic-edit', null, 50, 50, .50, 'image/webp', setIconCbICEdit, '#inputIconICEdit')"/>
</div>
