<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="updateModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalTitle"><?php echo lang('BTN_UPDATE_E_INFORMATION') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="updateForm">
            <input type="hidden" id="inputIdEdit" class="sr-only-rm" required>
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputTitleEdit" class="sr-only-rm"><?php echo lang('L_E_TITLE');?></label>
                      <div id="inputTitleEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                        </div>
                        <input type="text" id="inputTitleEdit" class="form-control" placeholder="<?php echo lang('L_E_TITLE');?>" required>
                      </div>
                      <div id="inputTitleEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputMaterialIconEdit" class="sr-only-rm">
                                  <a href="https://material.io/tools/icons/?style=baseline" target="_blank">
                                    <?php echo lang('L_E_MATERIAL_ICON');?>
                                  </a>
                                  <small>&#38;&#35;xe[code];</small>
                              </label>
                              <div id="inputMaterialIconEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i id="edit_mi" class="material-icons">&#xe838;</i></div>
                                </div>
                                <input type="text" id="inputMaterialIconEdit" class="form-control" placeholder="<?php echo lang('L_E_MATERIAL_ICON');?>" onInput="renderIcon('#inputMaterialIconEdit', '#edit_mi')" required>
                              </div>
                              <div id="inputMaterialIconEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputPositionEdit" class="sr-only-rm"><?php echo lang('L_E_POSITION');?></label>
                              <div id="inputPositionEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe051;</i></div>
                                </div>
                                <select type="text" id="inputPositionEdit" class="form-control" placeholder="<?php echo lang('L_E_POSITION');?>" required>
                                    <option value="-1"><?php echo lang('L_E_POSITION_NAV').' & '.lang('L_E_POSITION_BOTTOM');?></option>
                                    <option value="0"><?php echo lang('L_E_POSITION_NAV');?></option>
                                    <option value="1"><?php echo lang('L_E_POSITION_BOTTOM');?></option>
                                </select>
                              </div>
                              <div id="inputPositionEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputVisibilityEdit" class="sr-only-rm"><?php echo lang('L_E_VISIBILITY');?></label>
                              <div id="inputVisibilityEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
                                </div>
                                <select type="text" id="inputVisibilityEdit" class="form-control" required>
                                    <option value="1"><?php echo lang('L_E_VISIBILITY_SHOW');?></option>
                                    <option value="0"><?php echo lang('L_E_VISIBILITY_HIDE');?></option>
                                </select>
                              </div>
                              <div id="inputVisibilityEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-6">
                        <div class="form-group">
                          <label for="inputSlugEdit" class="sr-only-rm"><?php echo lang('L_E_SLUG');?></label>
                          <div id="inputSlugEditError" class="input-group border rounded">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">&#xe165;</i></div>
                            </div>
                            <input type="text" id="inputSlugEdit" class="form-control" placeholder="<?php echo lang('L_E_SLUG');?>" readonly required>
                          </div>
                          <div id="inputSlugEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        </div>

                        <div class="col col-12 col-sm-6">
                        <div class="form-group">
                          <label for="inputOrderingEdit" class="sr-only-rm"><?php echo lang('L_E_ORDERING');?></label>
                          <div id="inputOrderingEditError" class="input-group border rounded">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                            </div>
                            <input type="number" id="inputOrderingEdit" class="form-control" placeholder="<?php echo lang('L_E_ORDERING');?>" required>
                          </div>
                          <div id="inputOrderingEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputBriefDescriptionEdit" class="sr-only-rm"><?php echo lang('L_E_BRIEF_DESC');?></label>
                      <div id="inputBriefDescriptionEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe261;</i></span>
                        </div>
                        <textarea rows="4" type="email" id="inputBriefDescriptionEdit" class="form-control" placeholder="<?php echo lang('L_E_BRIEF_DESC');?>" required></textarea>
                      </div>
                      <div id="inputBriefDescriptionEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputFullDescriptionEdit" class="sr-only-rm"><?php echo lang('L_E_FULL_DESC');?></label>
                      <div id="inputFullDescriptionEditError" class="input-group-sr border-sr rounded-sr">
                        <!--
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe3c7;</i></span>
                        </div>
                        -->
                        <textarea rows="4" type="text" id="inputFullDescriptionEdit" class="form-control" placeholder="<?php echo lang('L_E_FULL_DESC');?>" required></textarea>
                      </div>
                      <div id="inputFullDescriptionEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button id="update_essential_information" type="button" class="btn btn-primary" onclick="updateEI()">
            <?php echo lang('BTN_UPDATE_E_INFORMATION') ?>
        </button>
      </div>
      <script>
          $('#inputFullDescriptionEdit').trumbowyg({semantic: false});
          $('#updateModal').on('hidden.bs.modal', function (e) {
              // $('#updateForm').trigger('reset')
          })
      </script>
    </div>
  </div>
</div>
