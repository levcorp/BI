<div class="box box-info">
  <div class="box-header">
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        <p style="font-size: 15px">
          <el-button @click="handleBackList()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
          <strong>&nbsp;&nbsp;Datos de Almacen</strong>
        </p>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
          <div class="pull-right" style="margin-right: 10px">
              <p style="font-size: 13px">
                <strong>
                  Total Articulos : 
                </strong>
                <el-tag size="mini" effect="dark" type="primary">@{{total.articulos}}</el-tag>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <strong>
                  Total Revisados :
                </strong>
                <el-tag size="mini" effect="dark" type="primary">@{{this.total.revisados}}</el-tag>
              </p>
          </div>
      </div>
    </div>
  </div>
    <div class="box-body">
        <div class="row">
          <div v-for="fabricante in fabricantes.fabricantes">
            <div class="col-12 col-sm-4 col-md-3 col-xs-12">
              <el-card shadow="hover" :body-style="{ padding: '0px' }">
                <div style="padding: 18px;">
                  <p style="color:#409EFF;font-size:13px">
                    <strong>
                     @{{fabricante.FABRICANTE}}
                    </strong>
                    <el-button @click="handleShowArticulos(fabricante)" class="pull-right" style="padding:3px;" size="mini" circle type="primary" icon="el-icon-plus"/>
                  </p>
                  <div style="border:solid 0.5px #E4E7ED; margin:6px 0px;width:100%"></div>
                  <p style="font-size:11px">
                    <div class="pull-left" style="font-size:13px">
                      <strong >#</strong> Articulos
                    </div>
                    <div class="pull-right">
                      <strong>@{{fabricante.COUNT_ARTICULOS}}</strong>
                    </div>
                  </p>
                  <br>
                  <div style="border:solid 0.5px #E4E7ED; margin:6px 0px;width:100%"></div>
                  <p style="font-size:11px">
                    <div class="pull-left" style="font-size:13px">
                      <strong>#</strong> Revisados
                    </div>
                    <div class="pull-right">
                      <strong>@{{fabricante.COUNT_ARTICULOS_CHECK}}</strong>
                    </div>
                  </p>
                  <br>
                </div>
              <div class="text-center">
                <el-tag :type="fabricante.COUNT_ARTICULOS_CHECK==fabricante.COUNT_ARTICULOS?'success':'danger'" effect="plain" size="mini" style="width:100%;">@{{fabricante.COUNT_ARTICULOS_CHECK==fabricante.COUNT_ARTICULOS?'Completado':'No completado'}}</el-tag>
              </div>
              </el-card>
              <br>
          </div>
        </div>
    </div>
  </div>
</div>
