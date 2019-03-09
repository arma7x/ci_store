<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="addModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel"><?php echo lang('BTN_ADD_E_INFORMATION') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputTitle" class="sr-only-rm"><?php echo lang('L_E_TITLE');?></label>
                      <div id="inputTitleError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                        </div>
                        <input type="text" id="inputTitle" class="form-control" placeholder="<?php echo lang('L_E_TITLE');?>" onInput="generateSlug('#inputTitle', '#inputSlug')" required>
                      </div>
                      <div id="inputTitleErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputMaterialIcon" class="sr-only-rm">
                                  <a href="https://material.io/tools/icons/?style=baseline" target="_blank">
                                    <?php echo lang('L_E_MATERIAL_ICON');?>
                                  </a>
                              </label>
                              <div id="inputMaterialIconError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i id="add_mi" class="material-icons">&#xe838;</i></div>
                                </div>
                                <input type="text" id="inputMaterialIcon" class="form-control" placeholder="<?php echo lang('L_E_MATERIAL_ICON');?>" onInput="renderIcon('#inputMaterialIcon', '#add_mi')" required>
                              </div>
                              <div id="inputMaterialIconErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputPosition" class="sr-only-rm"><?php echo lang('L_E_POSITION');?></label>
                              <div id="inputPositionError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe051;</i></div>
                                </div>
                                <select type="text" id="inputPosition" class="form-control" placeholder="<?php echo lang('L_E_POSITION');?>" required>
                                    <option value="-1"><?php echo lang('L_E_POSITION_NAV').' & '.lang('L_E_POSITION_BOTTOM');?></option>
                                    <option value="0"><?php echo lang('L_E_POSITION_NAV');?></option>
                                    <option value="1"><?php echo lang('L_E_POSITION_BOTTOM');?></option>
                                </select>
                              </div>
                              <div id="inputPositionErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputVisibility" class="sr-only-rm"><?php echo lang('L_E_VISIBILITY');?></label>
                              <div id="inputVisibilityError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
                                </div>
                                <select type="text" id="inputVisibility" class="form-control" required>
                                    <option value="0"><?php echo lang('L_E_VISIBILITY_HIDE');?></option>
                                    <option value="1"><?php echo lang('L_E_VISIBILITY_SHOW');?></option>
                                </select>
                              </div>
                              <div id="inputVisibilityErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputSlug" class="sr-only-rm"><?php echo lang('L_E_SLUG');?></label>
                              <div id="inputSlugError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe165;</i></div>
                                </div>
                                <input type="text" id="inputSlug" class="form-control" placeholder="<?php echo lang('L_E_SLUG');?>" required>
                              </div>
                              <div id="inputSlugErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6">
                            <div class="form-group">
                              <label for="inputOrdering" class="sr-only-rm"><?php echo lang('L_E_ORDERING');?></label>
                              <div id="inputOrderingError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
                                </div>
                                <input type="number" id="inputOrdering" class="form-control" placeholder="<?php echo lang('L_E_ORDERING');?>" required>
                              </div>
                              <div id="inputOrderingErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputBriefDescription" class="sr-only-rm"><?php echo lang('L_E_BRIEF_DESC');?></label>
                      <div id="inputBriefDescriptionError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe261;</i></span>
                        </div>
                        <textarea rows="4" type="email" id="inputBriefDescription" class="form-control" placeholder="<?php echo lang('L_E_BRIEF_DESC');?>" required></textarea>
                      </div>
                      <div id="inputBriefDescriptionErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputFullDescription" class="sr-only-rm"><?php echo lang('L_E_FULL_DESC');?></label>
                      <div id="inputFullDescriptionError" class="input-group-sr border-sr rounded-sr">
                        <!--
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe3c7;</i></span>
                        </div>
                        -->
                        <textarea rows="4" type="text" id="inputFullDescription" class="form-control" placeholder="<?php echo lang('L_E_FULL_DESC');?>" required></textarea>
                      </div>
                      <div id="inputFullDescriptionErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button id="add_essential_information" type="button" class="btn btn-primary" onclick="addEI()"><?php echo lang('BTN_ADD_E_INFORMATION') ?></button>
      </div>
      <script>
          $('#inputFullDescription').trumbowyg({semantic: false});
          $('#addModal').on('hidden.bs.modal', function (e) {
              // $('#addForm').trigger('reset')
          })
      </script>
    </div>
  </div>
</div>
