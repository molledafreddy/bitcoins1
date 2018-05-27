
    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
    <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Edición de Datos</h2>
                    </div>
                    <!-- END Modal Header -->
    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form  method="POST" action="{{ route('user.account') }}" class="form-horizontal form-bordered">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="col-md-12 " id="valor_imagen" >
                                    <label>Imagen</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Seleccione una Imagen
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text"  @if(!empty($logo_user->value))  value="{{$logo_user->value}}" @endif name="value"  required>
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;padding-bottom: 15px;"  @if(!empty($logo_user->value)) src="{{ asset($logo_user->value) }}" @endif>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Nombre</label>
                                    <div class="col-md-8">
                                    <input type="text" id="user-settings-email" name="name" class="form-control" value="{{Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Apellido</label>
                                    <div class="col-md-8">
                                    <input type="text" id="user-settings-email" name="lastname" class="form-control" value="{{Auth::user()->lastname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Usuario</label>
                                    <div class="col-md-8">
                                    <input type="text" id="user-settings-email" name="username" class="form-control" value="{{Auth::user()->username}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" id="user-settings-email" name="email" class="form-control" value="{{Auth::user()->email}}">
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-group form-actions">
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @push('scripts')

                    <script>
                        if ($('#editor1').length > 0) {
                            CKEDITOR.replace('editor1', {
                                filebrowserImageBrowseUrl: '../laravel-filemanager?type=Images',
                                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                                filebrowserBroeseUrl: '../laravel-filemanager?type=Files',
                                fullPage: true,
                                allowedContent: true,
                                allow_multi_user: true
                            });
                        }
                    
                        var domain = "../laravel-filemanager";
                        $('#lfm').filemanager('image', {prefix: domain});
                    </script>
                    @endpush
                    <!-- END Modal Body -->