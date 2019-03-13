
<div ng-controller="choiceStep6" class="form-select">	
	<form action="#" method="get" ng-submit="nextStape()">
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Votre projet</h2>	
			<p class="help-text">Veuillez décrire votre projet</p>
			<div  class="valuer-formulaire-step1" >

		        <div class="valuer-formulaire-step4   ng-star-inserted" formgroupname="step4" style="">
		<input type="texto" name="lieu" ng-model="datas.infos[0].lieu">
		<input type="texto" name="gpsx" ng-model="datas.infos[0].gpsx">
		<input type="texto" name="gpsy" ng-model="datas.infos[0].gpsy">

		<input type="texto" name="vente_loyer" ng-model="datas.infos[1].vente_loyer">

		<input type="texto" name="type" ng-model="datas.infos[3].type">
		
		<input type="texto" name="surface" ng-model="datas.infos[4].surface">
		<input type="texto" name="pieces" ng-model="datas.infos[4].pieces">
		<input type="texto" name="chambres" ng-model="datas.infos[4].chambres">
		<input type="texto" name="etages" ng-model="datas.infos[4].etages">
		<input type="texto" name="etat" ng-model="datas.infos[4].etat">
		<input type="texto" name="etage_im" ng-model="datas.infos[4].etage_im">

		<input type="texto" name="Balcon" ng-model="datas.infos[5].Balcon">
		<input type="texto" name="Concierge" ng-model="datas.infos[5].Concierge">
		<input type="texto" name="Cuisine" ng-model="datas.infos[5].Cuisine">
		<input type="texto" name="Piscine" ng-model="datas.infos[5].Piscine">
		<input type="texto" name="Chauffage" ng-model="datas.infos[5].Chauffage">
		<input type="texto" name="Garage" ng-model="datas.infos[5].Garage">
		<input type="texto" name="Terrasse" ng-model="datas.infos[5].Terrasse">
		<input type="texto" name="Ascenseur" ng-model="datas.infos[5].Ascenseur">
		<input type="texto" name="Parking" ng-model="datas.infos[5].Parking">
		<input type="texto" name="Cave" ng-model="datas.infos[5].Cave">

		<input type="texto" name="souhait" ng-model="datas.infos[6].souhait">
		<input type="texto" name="quand" ng-model="datas.infos[6].quand">
		<input type="texto" name="investissement" ng-model="datas.infos[6].investissement">

		<input type="texto" name="result_estimation" value="1">

        <div class="inputs-row">

          <div class="input-group">
            <h4 class="item-title" for="surface">Je souhaite <i class="fas fa-asterisk"></i></h4>
            <div class="inputNumberContainer">

 			<select class=" souhait"  required="required" ng-change="changeWish()" ng-model="data.souhait">  
                <option disabled="disabled" value="" selected="selected">Votre projet</option>
 					<option ng-repeat="etat in souhaits" class="" value="{{etat.value}}" ng-selected="data.souhait==etat.value" ng-bind="etat.label"></option>

              </select>



            </div>
          </div>
          <div class="input-group input-group-margin">
            <h4 class="item-title" for="nb_room">Pour quand <i class="fas fa-asterisk"></i></h4>
            <div class="select-wrapper">
              <select class="quand "  ng-model="data.quand" required="required">
                <option disabled="disabled" value="" selected="selected">Délai de réalisation</option>
                <option ng-repeat="etat in quand" class="" value="{{etat.value}}" ng-selected="data.quand==etat.value" ng-bind="etat.label"></option>
              </select>
            </div>
          </div>

        </div>

        <div class="inputs-row api-bdv">

          <div class="input-group" ng-hide="data.souhait!='sell'">
			<div class="styled-input-single">
			    <input type="checkbox" name="investissement" id="investissement" ng-model="data.investissement" id="investissement" />
			        <label for="investissement">
			        	C'est un projet d'investissement locatif
			    	</label>
			</div> 

          </div>

        </div>
        <button  type="submit" class="default text" name="button" type="button">Suivant</button>
      </div>

	      	</div>
		</div>
</form>
</div>
<style type="text/css">
.inputNumberContainer {
    margin: 10px;
}
	input[type=texto]{
		display: none;
	}
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