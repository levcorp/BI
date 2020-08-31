<div class="box box-info">
    <div class="box-header">
      <div class="row">
              <vs-button
                @click="handleShowDetalle"
                icon
                style=" display: inline-block;margin-left:15px"
              >
                <i class="bx bx-chevron-left"></i>
              </vs-button>
              <p style=" display: inline-block;font-size:15px;">
                <strong >
                  Detalle de Solicitud Nº
                </strong>
              </p>
      </div>
    </div>
    <div class="box-body">
      <vs-card-group>
          <vs-card>
            <template #title>
              <h3 style="font-size:14px;">
                <strong>
                  Creación de Solicitud de Fondos
                </strong>
              </h3>
            </template>
            <template #img>
              <img src="{{asset('images/card.jpg')}}" alt="">
            </template>
            <template #text>
              <p>

              </p>
            </template>
            <template #interactions>
              <vs-button success icon>
                <i class='bx bx-check'></i>
              </vs-button>
            </template>
          </vs-card>
          <vs-card>
            <template #title>
              <h3 style="font-size:14px;">
                <strong>
                  Autorizacion de Solicitud de Fondos
                </strong>
              </h3>
            </template>
            <template #img>
              <img src="{{asset('images/wait.jpg')}}" alt="">
            </template>
            <template #text>
              <p>
              </p>
            </template>
            <template #interactions>
              <vs-button success icon>
                <i class='bx bx-check'></i>
              </vs-button>
              <vs-button danger icon>
                <i class='bx bx-x'></i>
              </vs-button>
              <vs-button warn icon>
                <i class='bx bx-error'></i>
              </vs-button>
            </template>
          </vs-card>
          <vs-card>
            <template #title>
              <h3 style="font-size:14px;">
                <strong>
                  Desembolso de Solicitud de Fondos
                </strong>
              </h3>
            </template>
            <template #img>
              <img src="{{asset('images/wait.jpg')}}" alt="">
            </template>
            <template #text>
              <p>
              </p>
            </template>
            <template #interactions>
              <vs-button success icon>
                <i class='bx bx-check'></i>
              </vs-button>
              <vs-button danger icon>
                <i class='bx bx-x'></i>
              </vs-button>
              <vs-button warn icon>
                <i class='bx bx-error'></i>
              </vs-button>
            </template>
          </vs-card>
          <vs-card >
            <template #title>
              <h3 style="font-size:14px;">
                <strong>
                  Desembolso de Solicitud de Fondos
                </strong>
              </h3>
            </template>
            <template #img>
              <img src="{{asset('images/wait.jpg')}}" alt="">
            </template>
            <template #text>
              <p>
              </p>
            </template>
            <template #interactions>
              <vs-button success icon>
                <i class='bx bx-check'></i>
              </vs-button>
              <vs-button danger icon>
                <i class='bx bx-x'></i>
              </vs-button>
              <vs-button warn icon>
                <i class='bx bx-error'></i>
              </vs-button>
            </template>
          </vs-card>
          <vs-card >
            <template #title>
              <h3 style="font-size:14px;">
                <strong>
                  Desembolso de Solicitud de Fondos
                </strong>
              </h3>
            </template>
            <template #img>
              <img src="{{asset('images/wait.jpg')}}" alt="">
            </template>
            <template #text>
              <p>
              </p>
            </template>
            <template #interactions>
              <vs-button success icon>
                <i class='bx bx-check'></i>
              </vs-button>
              <vs-button danger icon>
                <i class='bx bx-x'></i>
              </vs-button>
              <vs-button warn icon>
                <i class='bx bx-error'></i>
              </vs-button>
            </template>
          </vs-card>
  </vs-card-group>
    </div>
</div>
