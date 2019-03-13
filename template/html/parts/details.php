<div ng-controller="choiceStep4" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Détail du bien</h2>	
			<p class="help-text">Vous devez sélectionner le type de bien avant de poursuivre</p>
			<div  class="valuer-formulaire-step1" >

		        <div class="valuer-formulaire-step4   ng-star-inserted" formgroupname="step4" style="">

        <div class="inputs-row">

          <div class="input-group">
            <h4 class="item-title" for="surface">Surface <i class="fas fa-asterisk"></i></h4>
            <div class="inputNumberContainer">
              <input class="surface " ng-model="data.surface" formcontrolname="surface" min="5" name="surface" placeholder="Exemple : 40m²" type="number">
            </div>

          </div>

          <div class="input-group input-group-margin">
            <h4 class="item-title" for="nb_room">Pièces <i class="fas fa-asterisk"></i></h4>
            <div class="select-wrapper">
              <select class="pieces "  ng-model="data.pieces" formcontrolname="nb_room" name="nb_room">
              	<option disabled="disabled" value="" selected="selected">Nombre de piece(s)</option>
                <option ng-repeat="piece in pieces" class="" value="{{piece.value}}" ng-selected="data.piece==piece.value" ng-bind="piece.label"></option>

              </select>
            </div>
          </div>

        </div>

        <div class="inputs-row">

          <div class="input-group">
            <h4 class="item-title" for="nb_bedroom">Chambres <i class="fas fa-asterisk"></i></h4>
            <div class="select-wrapper">
              <select class="chambres "  ng-model="data.chambres"  formcontrolname="nb_bedroom" name="nb_bedroom">
              <option disabled="disabled" value="" selected="selected">Nombre de Chambre(s)</option>

                <option ng-repeat="chambre in chambres" class="" value="{{chambre.value}}" ng-selected="data.chambres==chambre.value" ng-bind="chambre.label"></option>
              </select>
            </div>
          </div>

          <div class="input-group input-group-margin">
            <!----><h4 for="storey" class="item-title" >Etage <i class="fas fa-asterisk"></i></h4>
            <!---->
            <input class="etage " ng-model="data.etage"  formcontrolname="storey" min="0" name="storey" placeholder="1" type="number">
          </div>

        </div>

        <div class="inputs-row">

          
          <div class="input-group">
            <h4 class="item-title" ng-model="data.chambres"   for="nb_room">Etat du bien</h4>
            <div class="select-wrapper">
              <select class="etat " ng-model="data.etat" formcontrolname="etatBien">              	
              	<option disabled="disabled" value="" selected="selected">Etat du bien</option>

                <option ng-repeat="etat in etats" class="" value="{{etat.value}}" ng-selected="data.etat==etat.value" ng-bind="etat.label"></option>
              </select>
            </div>
          </div>

          
          <!----><div class="input-group input-group-margin ">
            <h4 class="item-title" for="nb_storey">Etage(s) de l'immeuble</h4>
            <input class="etages" ng-model="data.etages"  formcontrolname="nb_storey" name="nb_storey" placeholder="1" type="number" min="">
          </div>

          
          <!---->


        </div>

        <button class="default text" ng-click="nextStape()" name="button" type="button">Suivant</button>
      </div>

	      	</div>
		</div>
</div>
<style type="text/css">
	.step-estimation{
		display: none;
	}
	.active.step-estimation{
		display: none;
	    font-family: 'Nunito', sans-serif;
	}

	.center-horizontal{
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	.center-vertical{
		display: flex;
		flex-direction: row;
		justify-content: center;
	}
	#choiceWhere{
		display: flex;
	    border-radius: 5px;
	    justify-content: center;
	    background: white;
	    transition: ease background 1s;
	}
	#choiceWhere.bg-grad{
	    background: #567dab;
	    background: linear-gradient(135deg,#567dab 0%,#3465c7 100%);
	}
	.main-title{
	    text-align: left;
	    line-height: 22px;
		font-weight: 500;
	}
	#choiceWhere .form-select{
		width: 80%;
	    position: relative;
	    display: flex;
	    justify-content: center;
	}
	#choiceWhere .form-bg{
		width: 40%;
		/*display: flex;*/
		/*justify-content: center;*/
	}
	#choiceWhere .form-bg img{
		width: 80%;
		border-radius: 5px;
		margin: 10%;
	}
	.inputs-row {
	    display: flex;
	    justify-content: space-between;
	        margin-bottom: 45px;
	}
	.fas{
	    color: #e74c3c;
	    font-size: 6pt;
	}
	button.default.text {
		margin-top: 15px;
	    padding: 0 20px;
	    color: #fff;
	    background: #5277a3;
	    -webkit-box-shadow: 0 8px 40px 0 rgb(86, 125, 171);
	    box-shadow: 0 8px 40px 0 rgb(86, 125, 171);
	    border: none;
	    height: 40px;
	    border-radius: 3.5px;
	    -webkit-transition: .3s ease-in;
	    transition: .3s ease-in;
	}
	button.default.text:hover{
		transform: scale(1.15);
	}
	button.default.text , .content-dropdown .menu .item:hover{
		background: #567dab;
	    color: white;
	}
	.dropdown-box {
	    width: 79%;
	}
</style>
