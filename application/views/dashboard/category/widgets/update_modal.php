<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="updateInboxModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addInboxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInboxModalLabel"><?php echo lang('BTN_UPDATE_CATEGORY') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="updateForm">
            <input type="hidden" id="inputIdEdit" class="sr-only-rm" required>
            <div class="row">
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-8">
                            <div class="form-group">
                              <label for="inputNameEdit" class="sr-only-rm"><?php echo lang('L_CAT_NAME');?></label>
                              <div id="inputNameEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                                </div>
                                <input type="text" id="inputNameEdit" class="form-control" placeholder="<?php echo lang('L_CAT_NAME');?>" required>
                              </div>
                              <div id="inputNameEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputOrderingEdit" class="sr-only-rm"><?php echo lang('L_CAT_ORDERING');?></label>
                              <div id="inputOrderingEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrderingEdit" class="form-control" placeholder="<?php echo lang('L_CAT_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputSlugEdit" class="sr-only-rm"><?php echo lang('L_CAT_SLUG');?></label>
                      <div id="inputSlugEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">&#xe157;</i></div>
                        </div>
                        <input type="text" id="inputSlugEdit" class="form-control" placeholder="<?php echo lang('L_CAT_SLUG');?>" required>
                      </div>
                      <div id="inputSlugEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputIconEdit" class="sr-only-rm"><?php echo lang('L_CAT_ICON');?></label>
                      <div id="inputIconEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img id="iconHolderEdit" class="rounded-circle logo" style="width:50px;height:50px" alt="logo"/></span>
                        </div>
                        <textarea onInput="renderIcon('#inputIconEdit', '#iconHolderEdit')" id="inputIconEdit" rows="4" type="text" class="form-control" placeholder="<?php echo lang('L_CAT_ICON_PLACEHOLDER');?>"></textarea>
                      </div>
                      <div id="inputIconEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setIconByUrl('#inputIconEdit', '#iconHolderEdit')"><?php echo lang('BTN_IMG_FROM_URL') ?></button>
        <button type="button" class="btn btn-primary" onclick="triggerIcon('#upload-icon-edit')"><?php echo lang('BTN_IMG_TO_BASE64') ?></button>
        <button id="update_category" type="button" class="btn btn-primary" onclick="updateCategory()"><?php echo lang('BTN_UPDATE_CATEGORY') ?></button>
      </div>
    </div>
  </div>
  <input id="upload-icon-edit" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-icon-edit', null, 50, 50, .50, 'image/webp', setIconCbEdit, '#inputIconEdit')"/>
</div>
