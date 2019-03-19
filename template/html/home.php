
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />

<div ng-app="BonDeVisite">
<!-- 
<div  ng-controller="information" ng-hide='1'>
  <div>
    <div ng-repeat="elt in elements">
      <b ng-bind="elt.label"></b>:<span ng-bind="elt.value"></span>
    </div>
  </div>
   <button ng-click="refresh()">refresh</button>
</div> -->
<div  id="choiceWhere" class="step-estimation active" ng-view>

   <div class="blur" id="loader-end" >
      <span class="box box-left"></span>
      <span class="box box-right"></span>
    </div>
</div>
</div>
<script type="text/javascript" src="https://widget.bondevisite.fr/v2.0.0/bdv.js" crossorigin="anonymous"></script>

  <script type="text/javascript">
/*
var bdvwidget = bdv.init('widget-bdv', '46a70e16b75575a5231d117e1fb6fd8a841e67f8', 
  {
    score:true,
    luminosity:true,
    quietness:true,
    proximity:true,
    pollution:true,
    connectivity:true,
    safety:true,
    individualtax:true,
    sell:true,
    rent:true,
    dynamics:true,
    rates:true,
    sensitiveAddress:true,
    mapPermanent:true,
    map3d:false
  });
bdvwidget.setInput(
  {
    address:'11 rue victor cousin, Paris', 
    floor:8,
    rooms:4,
    surface:40});*/
</script>
<script>

var check_data = function(target,data,pivot){
      if(data<=pivot){
        jQuery(target).addClass("alert-me");
        return false;
      }
      console.log(target+" -> good");
      jQuery(target).removeClass("alert-me");
      return true;

    }
var money_val = function(r){
  r = (parseInt(r)+"").split("");
  var c = "";
  for(var j=0, i = r.length-1; i>=0;i--,j++){
    if((j)%3==0){c = r[i]+" "+c;}else{c = r[i]+c;}
  }
  return c;
}
var rate_html =function(n){
  var good = "<div class='bdv-icon-widget-score-thumbs'></div>";
  var bad = "<div class='bdv-icon-widget-score-thumbs bad-mark'></div>";
  var result = "";
  for(var i=0;i<5;i++){
    result += (i<n)?good:bad;
  }
  return result;
}
var mult_cinq = function(v){
  return Math.ceil(v/5)*5
}
var app = angular.module('BonDeVisite',  ["ngRoute"]);
app.filter('percentage', function() {
  return function(input, total) {
    if(total==0)total = input;
    input = (100*input)/total;
    total = parseInt(total);
    input = parseInt(input)
    return input;
  };
});
app.filter('range', function() {
  return function(input, total) {
    total = parseInt(total);

    for (var i=0; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});
app.factory('Data', function(){
    // I know this doesn't work, but what will?
    return {
    	stape:0,
    	infos:[
    		{
    			lieu:'',
          gpsx:0,
          gpsy:0
    		},
    		{
    			vente_loyer:''
    		},
        {
          lieu:'',
          gpsx:0,
          gpsy:0
        },
        {
          type:''
        },
        {
          surface:'',
          pieces:'',
          chambres:'',
          etages:'',
          etat:'',
          etage_im:'',
        },
        {
          Balcon:0,
          Concierge :0,
          Cuisine :0,
          Piscine :0,
          Chauffage :0,
          Garage :0 ,
          Terrasse : 0 ,
          Ascenseur : 0 ,
          Parking : 0,
          Cave : 0
        },
        {
          souhait:'',
          quand :'',
          investissement :''
        }
    	]
    }
});
app.config(function($routeProvider) {
	$routeProvider
	  .when("/", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/where.php'?>",
    controller : "choiceWhere"
	  })
	  .when("/quoi", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/what.php'?>",
    	controller : "choiceStep1"
	  })
	  .when("/emplacement", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/emplacement.php'?>",
    	controller : "choiceStep2"
	  })
	  .when("/type_appart", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/appartement.php'?>",
    	controller : "choiceStep3"
	  })
	  .when("/details", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/details.php'?>",
    	controller : "choiceStep4"
	  })
	  .when("/caracteristiques", {
	    templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/caracteristiques.php'?>",
    	controller : "choiceStep5"
	  })
    .when("/projet", {
      templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/projet.php'?>",
      controller : "choiceStep6"
    })
    .when("/estimation", {
      templateUrl : "<?php echo WPBDVAPI_URL.'template/html/parts/result.php'?>",
      controller : "result"
    });
	});
app.controller('information', function($scope, Data,$location) {  
  $scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.elements = [];
    $scope.refresh = function(){
      $scope.elements = [
        {
          label : "LIEU",
          value : Data.infos[0].lieu
        },
        {
          label:"VENTE OU LOCATION",
          value:Data.infos[1].vente_loyer
        },
        {
          label : "LIEU",
          value : Data.infos[2].lieu
        },
        {
          label : "TYPE APPART",
          value : Data.infos[3].type
        },
        {
          label : "PAGE2",
          value : "-------------------"
        },
        {
          label : "SURFACE APPART",
          value : Data.infos[4].surface
        },
        {
          label : "PIECES APPART",
          value : Data.infos[4].pieces
        },
        {
          label : "CHAMBRES APPART",
          value : Data.infos[4].chambres
        },
        {
          label : "ETAGE APPART",
          value : Data.infos[4].etages
        },
        {
          label : "ETAT APPART",
          value : Data.infos[4].etat
        },
        {
          label : "ETAGES IMMEUBLE",
          value : Data.infos[4].etage_im
        },
        {
          label : "PAGE3",
          value : "-------------------"
        },
        {
          label : "Balcon APPART",
          value : Data.infos[5].Balcon
        },
        {
          label : "Concierge APPART",
          value : Data.infos[5].Concierge
        },
        {
          label : "Cuisine APPART",
          value : Data.infos[5].Cuisine
        },
        {
          label : "Piscine APPART",
          value : Data.infos[5].Piscine
        },
        {
          label : "Chauffage APPART",
          value : Data.infos[5].Chauffage
        },
        {
          label : "Garage IMMEUBLE",
          value : Data.infos[5].Garage
        },
        {
          label : "Terrasse IMMEUBLE",
          value : Data.infos[5].Terrasse
        },
        {
          label : "Ascenseur IMMEUBLE",
          value : Data.infos[5].Ascenseur
        },
        {
          label : "Parking IMMEUBLE",
          value : Data.infos[5].Parking
        },
        {
          label : "Cave IMMEUBLE",
          value : Data.infos[5].Cave
        },
        {
          label : "souhait IMMEUBLE",
          value : Data.infos[6].souhait
        },
        {
          label : "quand IMMEUBLE",
          value : Data.infos[6].quand
        },
        {
          label : "investissement IMMEUBLE",
          value : Data.infos[6].investissement
        },
      ];
    }
    $scope.refresh();
});
app.controller('choiceWhere', function($scope, Data,$location) {	
	  $scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.where = Data.infos[0].lieu;
    jQuery("#choiceWhere").addClass("bg-grad");
    $scope.posibilities = [];

    var itemMenu = jQuery(".content-dropdown .menu");
    var openMenu = function(open){
    	open?itemMenu.slideDown(1000):itemMenu.slideUp(600);
    }
    $scope.nextStape= function(){
    	openMenu(false);
      if(check_data(".ui.dropdown",Data.infos[0].lieu,"")==false){
        openMenu(true);
        return;
      }

    	$location.path("/quoi");
    };
    $scope.choiceItem = function(item){
    	$scope.where = item;
      Data.infos[0].lieu = $scope.where;
    	openMenu(false);
      check_data(".ui.dropdown",Data.infos[0].lieu,"");
    }
    $scope.updateWhere = function(){
      jQuery.get("https://bdvapis.appspot.com/autocomplete/address",
      {
        text: $scope.where
        ,id: 6462
      },
      function(data, status){
        $scope.posibilities= [];
        if(status=="success"){
          console.log(data.total);
          for(var i =0;i<data.total ;i++){
            var item = data.hits[i];
          console.log(item._source.address);
            $scope.posibilities.push(item._source.address);
          }
        }
      });
    	openMenu(true);
    }
});
app.controller('choiceStep1', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.posibilities = [
	    {
	    	id:0,
	    	label:"🏠 Estimez un bien",
	    	message:"Pour un bien que voulez vendre ou acquérir."
	    },
	    {
	    	id:1,
	    	label:"💸 Estimez un loyer",
	    	message:"Pour un bien que vous voulez louer ou mettre en location."
	    }
    ];
  	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.choiceItem = function(elt){
    	Data.infos[1].vente_loyer = elt.id;

    	$scope.nextStape();
    }

    $scope.nextStape= function(){


    	$location.path("/type_appart");

    };
});
app.controller('choiceStep2', function($scope, Data,$location) {
	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.where = Data.infos[0].lieu;
    $scope.posibilities = [
    ];
    var itemMenu = jQuery(".content-dropdown .menu");
    var openMenu = function(open){
    	open?itemMenu.slideDown(1000):itemMenu.slideUp(600);
    }
    $scope.nextStape= function(){
    	openMenu(false);
      Data.infos[2].lieu = $scope.where;
    	$location.path("/type_appart");
    };
    
    $scope.choiceItem = function(item){
      $scope.where = item.label;
      Data.infos[0].lieu = $scope.where;
      Data.infos[0].gpsx = item.gpsx;
      Data.infos[0].gpsy = item.gpsy;
      openMenu(false);
    }
    $scope.updateWhere = function(){
      jQuery.get("https://bdvapis.appspot.com/autocomplete/area",
      {
        text: $scope.where
        ,id: 6462
      },
      function(data, status){
        $scope.posibilities= [];
        if(status=="success"){
          for(var i =0;i<data.total;i++){
            var item = data.hits[i];
            $scope.posibilities.push(item);
          }
        }
      });
      openMenu(true);
    }
});
app.controller('choiceStep3', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.choice = 0;
    $scope.posibilities = [
	    {
	    	id:1,
	    	label:"Appartement",
	    	icon:"building"
	    },
	    {
	    	id:0,
	    	label:"Maison",
	    	icon:"home"
	    }
    ];
	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.choiceItem = function(elt){
    	$scope.choice = elt.id;
    	//Data.infos[1].vente_loyer = elt.id;
    	//$scope.nextStape();
      Data.infos[3].type = $scope.choice;
    }

    $scope.nextStape= function(){
    	$location.path("/details");
    };
});
app.controller('choiceStep4', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.choice = 0;
    $scope.chambres = [
      {label:"1 chambre",value:"1"},
      {label:"2 chambres",value:"2"},
      {label:"3 chambres",value:"3"},
      {label:"4 chambres",value:"4"},
      {label:"5 chambres",value:"5"},
      {label:"6 chambres",value:"6"},
      {label:"7 chambres",value:"7"},
      {label:"8 chambres et plus",value:"8"},
    ]; 
    $scope.pieces = [
      {label:"1 piece",value:"1"},
      {label:"2 pieces",value:"2"},
      {label:"3 pieces",value:"3"},
      {label:"4 pieces",value:"4"},
      {label:"5 pieces",value:"5"},
      {label:"6 pieces",value:"6"},
      {label:"7 pieces",value:"7"},
      {label:"8 pieces et plus",value:"8"},
    ];
    $scope.etats = [
      {label:"Refait à neuf",value:"1"},
      {label:"Standard",value:"2"},
      {label:"Nécessite un rafraichissement",value:"3"},
      {label:"Nécessite des travaux importants",value:"4"},
    ];
    $scope.data = {
          surface : Data.infos[4].surface,
          pieces : Data.infos[4].pieces,
          chambres : Data.infos[4].chambres,
          etage : Data.infos[4].etages,
          etat : Data.infos[4].etat,
          etages : Data.infos[4].etage_im
      };
	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.choiceItem = function(elt){
    	$scope.choice = elt.id;
    }
    $scope.nextStape= function(){

      Data.infos[4].surface = $scope.data.surface;
      Data.infos[4].pieces = $scope.data.pieces;
      Data.infos[4].chambres = $scope.data.chambres;
      Data.infos[4].etages= $scope.data.etage ;
      Data.infos[4].etat = $scope.data.etat;
      Data.infos[4].etage_im = $scope.data.etages;

      var retour = check_data("input.surface",Data.infos[4].surface,0);
      retour &= check_data("select.pieces",Data.infos[4].pieces,'');
      retour &= check_data("select.chambres",Data.infos[4].chambres,'');
      retour &= check_data("input.etage",Data.infos[4].etages,0);
      // retour &= check_data("select.etat",Data.infos[4].etat,'');
      // retour &= check_data("input.etages",Data.infos[4].etage_im,0) ;
      if(retour){
        $location.path("/caracteristiques");
      }
    };
});
app.controller('choiceStep5', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.choice = 0;
    $scope.posibilities = [
	    [
        {id:"Balcon",label:"Balcon",value:Data.infos[5].Balcon},
        {id:"Concierge",label:"Concierge",value:Data.infos[5].Concierge}
      ],
      [
        {id:"Cuisine",label:"Cuisine américaine",value:Data.infos[5].Cuisine},
        {id:"Piscine",label:"Piscine",value:Data.infos[5].Piscine}
      ],
      [
        {id:"Chauffage",label:"Chauffage collectif",value:Data.infos[5].Chauffage},
        {id:"Garage",label:"Garage",value:Data.infos[5].Garage}
      ],
      [
        {id:"Terrasse",label:"Terrasse",value:Data.infos[5].Terrasse},
        {id:"Ascenseur",label:"Ascenseur",value:Data.infos[5].Ascenseur}
      ],
      [
        {id:"Parking",label:"Parking",value:Data.infos[5].Parking}
      ],
      [
        {id:"Cave",label:"Cave",value:Data.infos[5].Cave}
      ]
    ];
	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.choiceItem = function(elt){
    	$scope.choice = elt.id;
    }

    $scope.nextStape= function(){
      Data.infos[5].Balcon = $scope.posibilities[0][0].value?1:0;
      Data.infos[5].Concierge = $scope.posibilities[0][1].value?1:0;
      Data.infos[5].Cuisine = $scope.posibilities[1][0].value?1:0;
      Data.infos[5].Piscine = $scope.posibilities[1][1].value?1:0;
      Data.infos[5].Chauffage = $scope.posibilities[2][0].value?1:0;
      Data.infos[5].Garage = $scope.posibilities[2][1].value?1:0;
      Data.infos[5].Terrasse = $scope.posibilities[3][0].value?1:0;
      Data.infos[5].Ascenseur = $scope.posibilities[3][1].value?1:0;
      Data.infos[5].Parking = $scope.posibilities[4][0].value?1:0;
      Data.infos[5].Cave = $scope.posibilities[5][0].value?1:0;
      
    	$location.path("/projet");
    };
});
app.controller('choiceStep6', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
    $scope.choice = 0;
    $scope.datas = Data;
    $scope.souhaits = [
      {
        value:"sell",
        label:"Je suis propriétaire bailleur",
      },
      {
        value:"purchase",
        label:"Je suis locataire",
      }
    ];
    $scope.quand = [
      {
        value:"Immediately",
        label:"Immédiatement",
      },
      {
        value:"less than 3",
        label:"Dans 3 mois",
      },
      {
        value:"between 3 and 6",
        label:"Entre 3 et 6 mois",
      },
      {
        value:"more than 6",
        label:"Dans plus de 6 mois",
      }
    ];

    if(Data.infos[1].vente_loyer){
      $scope.souhaits = [
        {
          value:"renter",
          label:"Je suis propriétaire bailleur",
        },
        {
          value:"rent",
          label:"Je suis locataire",
        }
      ];
    }else{
      $scope.souhaits = [
        {
          value:"purchase",
          label:"Je souhaite acheter ce bien",
        },
        {
          value:"sell",
          label:"Je souhaite vendre ce bien",
        }
      ];
      
    }
    $scope.data = {
    	souhait:Data.infos[6].souhait,
    	quand:Data.infos[6].quand,
      investissement:Data.infos[6].investissement
    };
    $scope.changeWish = function(){
      $scope.data.investissement = 0;
    }
	$scope.url_site = "<?php echo WPBDVAPI_URL?>";
    $scope.choiceItem = function(elt){
    	$scope.choice = elt.id;
    }

    $scope.nextStape= function(){
      Data.infos[6].souhait = $scope.data.souhait;
      Data.infos[6].quand = $scope.data.quand;
      Data.infos[6].investissement = $scope.data.investissement;

      return  check_data("select.quand",Data.infos[6].quand,'');
      if(retour){
        $location.path("/estimation");
      }
    };
});
app.controller('result', function($scope, Data,$location) {
    jQuery("#choiceWhere").removeClass("bg-grad");
   $scope.estimation_min = 0;
   $scope.estimation_val = 0;
   $scope.estimation_max = 0;
  $scope.url_site = "<?php echo WPBDVAPI_URL?>";
  $scope.possibility = {
    evaluation_fiscalite_value:0,
    evaluation_fiscalite:[
      {
        id:"ensoleillement",
        label:"Ensoleillement",
        rate:3
      },
      {
        id:"calme",
        label:"Calme",
        rate:4
      },
      {
        id:"qualite",
        label:"Qualité de l'air",
        rate:5
      },
      {
        id:"proximite",
        label:"Proximité",
        rate:3
      },
      {
        id:"securite",
        label:"Securité",
        rate:3
      },
      {
        id:"connectivity",
        label:"Connectivité",
        rate:3
      }
    ]
  }
  $scope.result = function(){
  jQuery("#contents-main .container-contentbar").css("width","100%") ;    
  jQuery("#contents-main .container-sidebar.sidebar-right.default-sidebar").hide()

  jQuery.get("https://bdv-apis-preprod.appspot.com/46a70e16b75575a5231d117e1fb6fd8a841e67f8/geostat/v1.0.3/score",
    {
      browser: "Chrome",
      geoloc: Data.infos[0].gpsx+","+Data.infos[0].gpsy,//Data.infos[2].lieu,
      scorelist: "luminosity,quietness,pollution,cooking,services,transportation,education,entertainment,connectivity,safety,dynamics,luminosity,quietness,pollution,connectivity,safety,dynamics,sentence",
      option: "rates",
      device: "computer",
      floor: 1
      ,id: 6462
    },
    function(data, status){
      if(status=="success"){
        jQuery("#fiscalite-ensoleillement .list-good-item").html(rate_html(Math.ceil(data.results.luminosity)));
        jQuery("#fiscalite-calme .list-good-item").html(rate_html(Math.ceil(data.results.quietness)));
        jQuery("#fiscalite-qualite .list-good-item").html(rate_html(Math.ceil(data.results.pollution)));
        jQuery("#fiscalite-proximite .list-good-item").html(rate_html(Math.ceil(data.results.services)));
        jQuery("#fiscalite-securite .list-good-item").html(rate_html(Math.ceil(data.results.safety)));
        jQuery("#fiscalite-Connectivité .list-good-item").html(rate_html(Math.ceil(data.results.connectivity)));
        var total = data.results.luminosity + data.results.quietness + data.results.pollution + data.results.services + data.results.safety + data.results.connectivity;
        var note = Math.ceil((total/6)*10)/10;

        jQuery("#cercle-notation").attr("class","progress--circle progress--"+mult_cinq(note*10));

        jQuery("#cercle-notation div").html(note);



      }
    });
  jQuery.get("https://bdvapis.appspot.com/46a70e16b75575a5231d117e1fb6fd8a841e67f8/valuation/v2.0.0/rent",
    {
      valuationType: "bien",
      geoloc: Data.infos[0].gpsx+","+Data.infos[0].gpsy,//Data.infos[2].lieu,
      floor: 2,
      surface: Data.infos[4].surface,
      nb_room: Data.infos[4].pieces,
      nb_bedroom: Data.infos[4].chambres
      // ,id: 6462
    },
    function(data, status){
      if(status=="success"){
        var max = data.results.results.mainValuation.virtual_price_max;
        var min = data.results.results.mainValuation.virtual_price_min;
        jQuery("#rent-min").html(min+"%");
        jQuery("#rent-max").html(max+"%");
      }
    });
    jQuery.get("https://bdvapis.appspot.com/46a70e16b75575a5231d117e1fb6fd8a841e67f8/valuation/v2.0.0/purchase",
    {
      valuationType: "bien",
      geoloc: Data.infos[0].gpsx+","+Data.infos[0].gpsy,//Data.infos[2].lieu,
      geolocInsee: "2A041",//UNKNOWN
      property_type: Data.infos[3].type,//0:MAISON , 1 : APPARTEMENT
      surface: Data.infos[4].surface,
      nb_room: Data.infos[4].pieces,
      nb_bedroom: Data.infos[4].chambres,
      storey: Data.infos[4].etages,
      nb_storey: Data.infos[4].etage_im,
      etatBien: Data.infos[4].etat,
      concierge:  Data.infos[5].Concierge,
      balcony: Data.infos[5].Balcon,
      open_kitchen: Data.infos[5].Cuisine,
      swimmingpool: Data.infos[5].Piscine,
      garage: Data.infos[5].Garage,
      elevator: Data.infos[5].Ascenseur,
      terrace: Data.infos[5].Terrasse,
      collective_heating: 1,
      parking: Data.infos[5].Parking,
      cellaer: Data.infos[5].Cave,
      project_type: Data.infos[6].souhait,
      project_delay: Data.infos[6].quand,
      type: Data.infos[6].investissement
      ,id: 6462
    },
    function(data, status){
      if(status=="success"){
        var position = [ 2.3488,48.8534];
        if(Data.infos[0].gpsx && Data.infos[0].gpsy){
          position = [ Data.infos[0].gpsx,Data.infos[0].gpsy];
        }
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXJtZWxhdXNpdGVvZGl0IiwiYSI6ImNqc2E0YjkxczB4MTM0M3BuNWZlcXRhb3MifQ.qUwEzER3SquyYQNatgho1A';
          var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: position, // starting position
          zoom: 16 // starting zoom
        });
        $scope.estimation_max = data.results.results.mainValuation.confidence_max;//97451.6
        $scope.estimation_min = data.results.results.mainValuation.confidence_min;//63625.4
        $scope.estimation_val = data.results.results.mainValuation.predicted_price;//80538.5
        jQuery(".estimation-fourchette-min .price").html(money_val($scope.estimation_min)+"€");
        jQuery(".estimation-fourchette-max .price").html(money_val($scope.estimation_max)+"€");


        jQuery("#financement-frais-notariaux").attr("class","progress--circle progress--"+mult_cinq(data.results.results.thirdPartyFees.agency_fees_ratio));
        jQuery("#financement-frais-agence").attr("class","progress--circle progress--"+mult_cinq(data.results.results.thirdPartyFees.notary_fees_ratio));

        jQuery("#financement-frais-notariaux span").html(parseInt(data.results.results.thirdPartyFees.agency_fees_ratio));
        jQuery("#financement-frais-agence span").html(parseInt(data.results.results.thirdPartyFees.notary_fees_ratio));


        jQuery(".estimation-center .price").html(money_val($scope.estimation_val)+"€");
        jQuery("#emprunt-mensualite ._10").attr("data-percent",data.results.results.thirdPartyFees.monthly_mortage_10_years);
        jQuery("#emprunt-mensualite ._15").attr("data-percent",data.results.results.thirdPartyFees.monthly_mortage_15_years);
        jQuery("#emprunt-mensualite ._20").attr("data-percent",data.results.results.thirdPartyFees.monthly_mortage_25_years);
        var max = data.results.results.thirdPartyFees.monthly_mortage_10_years;
        setTimeout(function start (){
      
          jQuery('.bar').each(function(i){  
            var $bar = jQuery(this);
            jQuery(this).append('<span class="count"></span>')
            setTimeout(function(){
              var val = parseInt((parseInt($bar.attr('data-percent').replace("%",""))*70)/max);;
              $bar.css('width', (val+20)+"%");      
            }, i*100);
          });

        jQuery('.count').each(function () {
            jQuery(this).prop('Counter',0).animate({
                Counter: jQuery(this).parent('.bar').attr('data-percent')
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    jQuery(this).text(Math.ceil(now) +' €');
                }
            });
        });

    }, 500)

      }
    });
  }
  $scope.result();
});
</script>
<style type="text/css">
	
  .item-title{
        margin: 0 0 15px;
        /*font-family: Work sans;*/
        font-size: 20px;
        letter-spacing: -1px;
        font-weight: 200;
        color: #2a2a2a;
  }
	p.help-text {
	    line-height: initial;
	    font-size: medium;
	    margin-bottom: 5vh;
	    margin-top: 2vh;
	}
	.main-title{
	    text-align: left;
	    line-height: 35px;
		font-weight: 500;
	}
  .alert-me{
    border:1px solid red !important;
  }

  .input-group input{
        padding: 27px 20px;
      width: 200px;
      border: 1px solid #e2e2e2;
      font-size: 13px;
      font-weight: 200;
      font-family: 'Nunito sans',sans-serif;
      color: #2a2a2a;
      border-radius: 5px;
  }
  .input-group select{
      padding: 15px 20px;
      width: 200px;
      border: 1px solid #e2e2e2;
      font-family: 'Nunito sans',sans-serif;
      font-size: 13px;
      font-weight: 200;
      color: #2a2a2a;
      border-radius: 5px;
      -webkit-appearance: none;
  }

  .input-group select:after {
      font-family: 'Font Awesome\ 5 Free';
      font-weight: 900;
      content: '\f107';
      font-size: 18px;
      position: absolute;
      top: 18px;
      right: 9px;
      color: #434b67;
      pointer-events: none;
  }
</style>

<style type="text/css">
	.api-bdv .styled-input-single {
  position: relative;
  padding: 20px 0 20px 40px;
  text-align: left;
}
.api-bdv .styled-input-single label {
  cursor: pointer;
}
.api-bdv .styled-input-single label:before, .api-bdv .styled-input-single label:after {
  content: '';
  position: absolute;
  top: 50%;
  border-radius: 50%;
}
.api-bdv .styled-input-single label:before {
  left: 0;
  width: 30px;
  height: 30px;
  margin: -15px 0 0;
  background: #fff;
  box-shadow: 0 0 1px grey;
}
.api-bdv .styled-input-single label:after {
  left: 5px;
  width: 20px;
  height: 20px;
  margin: -10px 0 0;
  opacity: 0;
  background: #567dab;
  -webkit-transform: translate3d(-40px, 0, 0) scale(0.5);
          transform: translate3d(-40px, 0, 0) scale(0.5);
  transition: opacity 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
  transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out;
  transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
}
.api-bdv .styled-input-single input[type="radio"],
.api-bdv .styled-input-single input[type="checkbox"] {
  position: absolute;
  top: 0;
  left: -9999px;
  visibility: hidden;
}
.api-bdv .styled-input-single input[type="radio"]:checked + label:after,
.api-bdv .styled-input-single input[type="checkbox"]:checked + label:after {
  -webkit-transform: translate3d(0, 0, 0);
          transform: translate3d(0, 0, 0);
  opacity: 1;
}
.api-bdv .styled-input--square label:before, .api-bdv .styled-input--square label:after {
  border-radius: 0;
}
.api-bdv .styled-input--rounded label:before {
  border-radius: 10px;
}
.api-bdv .styled-input--rounded label:after {
  border-radius: 6px;
}
.api-bdv .styled-input--diamond .styled-input-single {
  padding-left: 45px;
}
.api-bdv .styled-input--diamond label:before, .api-bdv .styled-input--diamond label:after {
  border-radius: 0;
}
.api-bdv .styled-input--diamond label:before {
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
}
.api-bdv .styled-input--diamond input[type="radio"]:checked + label:after,
.api-bdv .styled-input--diamond input[type="checkbox"]:checked + label:after {
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
  opacity: 1;
}
.api-bdv body {
  font-family: sans-serif;
  max-width: 400px;
  margin: 0 auto;
  padding: 30px;
  font-family: 'Maven Pro', sans-serif;
  text-align: center;
}
.api-bdv h1 {
  font-size: 2.8rem;
}
.api-bdv h2 {
  font-size: 2rem;
}
.api-bdv h1, .api-bdv h2 {
  font-family: 'Yrsa', cursive;
}
.api-bdv p {
  font-size: 1.25rem;
  line-height: 1.75rem;
}
.api-bdv hr {
  margin: 40px auto;
  max-width: 100px;
  display: block;
  height: 1px;
  border: 0;
  border-top: 1px solid #ccc;
  padding: 0;
}
.api-bdv .pen-intro {
  text-align: center;
}
.api-bdv .two-column:after {
  content: "";
  display: table;
  clear: both;
}
.api-bdv .two-column {
  margin: 0 0 40px;
}
@media (min-width: 860px) {
  .api-bdv .two-column {
    display: flex;
  }
}
.api-bdv .two-column .single-col {
  margin: 0 0 40px;
}
@media (min-width: 860px) {
  .api-bdv .two-column .single-col {
    width: 47.5%;
    float: left;
    margin: 0 0 0 5%;
  }
  .api-bdv .two-column .single-col:nth-child(2n+1) {
    clear: both;
    margin: 0;
  }
}

</style>



<style type="text/css">
  
  .blur {
    margin: 0 auto;
    display: block;
    width: 300px;
    height: 150px;
    position: relative;
    background: #fff;
  }

  .box {
    display: block;
    height: 70px;
    width: 70px;
    position: relative;
    background: #fff;
    border-radius: 50%;
    left: 0%;
    background-color: #3a6490;
  }

  .box-left {
    left: 40%;
    top: 25%;
    background-color: #3a6490;
    -webkit-animation: go-r 3s ease-out infinite;
    animation: go-r 3s ease-out infinite;
  }

  .box-right {
    left: 15%;
    top: -22%;
    -webkit-animation: go-l 4s ease-out infinite;
    animation: go-l 4s ease-out infinite;
  }

  @-webkit-keyframes go-r {
    0%, 100% {
      left: 20%;
      -webkit-transform: scale(1.2);
      transform: scale(1.2);
    }
    50% {
      left: 50%;
      -webkit-transform: scale(0.5);
      transform: scale(0.5);
    }
  }
  @-webkit-keyframes go-l {
    0%, 100% {
      left: 50%;
    }
    50% {
      left: 20%;
      -webkit-transform: scale(0.8);
      transform: scale(0.8);
    }
  }
  /*style for this pen - you don't need to copy this style to use the loader */
  .position {
    margin: 0 auto;
  }

  .pen-style {
    text-align: center;
    margin-top: 20px;
  }
  .pen-style a {
    text-decoration: none;
    font-weight: bold;
    color: #3a6490;
  }
  .pen-style a:hover {
    color: #3a6490;
  }



</style>

<style type="text/css">
@media screen and (max-width: 480px){

  div.valuer-result-global-estimation>div {
      margin-bottom: 28px;
      padding: 0px;
  }
  div.valuer-result-global-estimation {
    flex-direction: column;
    padding: 10px;
    width: 100%;
  }
  .valuer-result-global-estimation h3 {
      font-size: 7pt;
  }
    .valuer-result-global-estimation h1.center {
      font-size: 15pt;
  }
  .valuer-result-global-estimation h1 {
    font-size: 13pt;
  }
  div.holder-box-comp {
    flex-direction: column;
    width: 100%;
  }
  div.holder-box-comp > div {
    width: 100%;
    padding-top: 30%;
    text-align: center;
  }
  h2.main-title {
    font-size: 12pt;
    text-align: center;
  }
  div.dropdown-box.center-horizontal p {
    font-size: 9pt;
    text-align: justify;
  }
  .line-up-tax > div b {
    font-size: 10pt;
  }
  .line-up-tax > div i {
    font-size: 6pt;
    color: #3a3939;
  }
  div.bar-circle-block .progress__number {
    font-size: 8.5pt !important;
  }
  div.financement-barcircle > div.progress--circle {
    width: 100px;
    height: 100px;
  }
  div.bar.cf span.label {
    text-align: left;
    width: fit-content !important;
  }
  div.bar.cf span.count {
    margin-left: 15px;
    font-size: 8pt;
    margin-top: 5px;
  }
  .valuer-sub-menu ul.estimation-menu {
    margin-left: 0px;
    display: table-row-group;
  }
  .valuer-sub-menu ul.estimation-menu li {
    display: contents;
    border: none;
    padding: 0;
  }
  .valuer-sub-menu ul.estimation-menu li:after {
    content: ' |';
    color: #757474;
  }
  .valuer-sub-menu ul.estimation-menu li:last-child:after{
    content: none;
  }
  .valuer-sub-menu ul.estimation-menu li.active a {
    color: #3a6490 !important;
  }
}
.bdv-title-rate.bdv-no-padding.bdv-grid-xs-12 > div {
    color: #4777a2;
}
</style>