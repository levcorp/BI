const mix = require('laravel-mix');
mix.js([
      'resources/js/detalleSolicitud.js',
      //'resources/js/SolicitudABM.js'      
      ], 'public/js/detalleSolicitud.js');