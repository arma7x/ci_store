<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="addInboxModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addInboxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInboxModalLabel"><?php echo lang('BTN_ADD_INBOX_CHANNEL') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputNameIC" class="sr-only-rm"><?php echo lang('L_S_C_NAME');?></label>
                              <div id="inputNameICError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                                </div>
                                <input type="text" id="inputNameIC" class="form-control" placeholder="<?php echo lang('L_S_C_NAME');?>" required>
                              </div>
                              <div id="inputNameICErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputOrderingIC" class="sr-only-rm"><?php echo lang('L_S_C_ORDERING');?></label>
                              <div id="inputOrderingICError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrderingIC" class="form-control" placeholder="<?php echo lang('L_S_C_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingICErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputURLIC" class="sr-only-rm"><?php echo lang('L_S_C_URL');?></label>
                      <div id="inputURLICError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe157;</i></div>
                        </div>
                        <input type="text" id="inputURLIC" class="form-control" placeholder="<?php echo lang('L_S_C_URL');?>" required>
                      </div>
                      <div id="inputURLICErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIconIC" class="sr-only-rm"><?php echo lang('L_S_C_ICON');?></label>
                      <div id="inputIconICError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolderIC" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIconIC', '#iconHolderIC')" id="inputIconIC" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_S_C_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconICErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIconIC', '#iconHolderIC')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon-ic')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="add_inbox_channel" type="button" class="btn btn-primary" onclick="addInboxChannel()"><?php echo lang('BTN_ADD_INBOX_CHANNEL') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon-ic" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon-ic', null, 50, 50, .50, 'image/webp', setIconCbICAdd, '#inputIconIC')"/>
</div>
