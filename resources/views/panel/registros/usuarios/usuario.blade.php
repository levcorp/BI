<div class="modal fade" id="user"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
                <div class="box">
                    <div class="box-body box-profile">
                        @if(Auth::user()->avatar)            
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" alt="Avatar">
                        @else
                            <img src="{{ Avatar::create(ucwords(Auth::user()->nombre." ".Auth::user()->apellido))->toBase64() }}" class="profile-user-img img-responsive img-circle" alt="User Image" />
                        @endif
                        <h3 class="profile-username text-center">{{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}}</h3>
                        <p class="text-muted text-center">{{ucwords(Auth::user()->cargo)}}</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Departamento</b> <a class="pull-right">{{ucwords(Auth::user()->departamento)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Ciudad</b> <a class="pull-right">{{ucwords(Auth::user()->ciudad)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Correo Electronico</b> <a class="pull-right">{{Auth::user()->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Celular</b> <a class="pull-right">{{ucwords(Auth::user()->celular)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Telefono Interno</b> <a class="pull-right">{{ucwords(Auth::user()->interno)}}</a>
                            </li>
                        <input type="text" :value="id='{{Auth::user()->id}}'" hidden>
                            <li class="list-group-item">
                                 <md-field>
                                <label>Cambiar Imagen</label>
                                <md-file v-on:change="imagePreview($event)" accept="image/*" />
                            </md-field>
                            </li>
                        </ul>
                        <div class="text-center">
                            <el-button data-dismiss="modal" plain aria-label="Close" size="medium" round type="primary">Salir</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>