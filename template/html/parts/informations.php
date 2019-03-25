<div ng-controller="infoCtrl" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Informations personnelles</h2>	
			<p class="help-text">Veuillez vos informations personnelles pour recevoir le devis du bien estime</p>
			<form  class="valuer-formulaire-step1 api-bdv" method="get" action="#">

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
				<input type="texto" name="surface_jardin" ng-model="datas.infos[4].surface_jardin">

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
				<input type="texto" name="time" value="<?php echo time() ?>">

				<input type="texto" name="souhait" ng-model="datas.infos[6].souhait">
				<input type="texto" name="quand" ng-model="datas.infos[6].quand">
				<input type="texto" name="investissement" ng-model="datas.infos[6].investissement">


				<input type="texto" name="result_estimation" value="1">


		        <div class="valuer-formulaire-step4   ng-star-inserted" formgroupname="step4" style="">


				<div class="inputs-row" ng-repeat="caracteristique in posibilities">
		          	<div class="input-group">
		            	<label class="" for="{{caracteristique.label}}"><i class="fas fa-asterisk"></i>{{caracteristique.label}}</label>
		            	<div class="inputNumberContainer">
		              		<input class="surface " required="required" type="text" ng-model="caracteristique.value" name="{{caracteristique.id}}" id="{{caracteristique.label}}" placeholder="{{caracteristique.label}}">
		            	</div>
		        	</div>
		        </div>



		        <button class="default text" type="submit">Terminer</button>
		      </div>

	      	</form>
		</div>
</div>
<style type="text/css">

	input[type=texto]{
		display: none;
	}
.api-bdv .styled-input-single label {
    line-height: initial;
    font-weight: 400;
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
	}
	.inputs-row > div{
		width: 50%;
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

	.input-group input{
		background: white;
		margin-bottom: 15px;
	}
	.input-group {
	    display: flex;
	    justify-content: space-between;
	    width: 60% !important;
	}
</style>