<div ng-controller="choiceStep5" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Caractèristique du bien</h2>	
			<p class="help-text">Veuillez sélectionner les spécificités du bien à estimer</p>
			<div  class="valuer-formulaire-step1 api-bdv" >

		        <div class="valuer-formulaire-step4   ng-star-inserted" formgroupname="step4" style="">
		<div class="inputs-row" ng-repeat="caracteristiques in posibilities">
          <div class="input-group" ng-repeat="caracteristique in caracteristiques">
			<div class="styled-input-single">
			        <input type="Checkbox" ng-model="caracteristique.value" name="{{caracteristique.id}}" id="{{caracteristique.label}}" />
			        <label for="{{caracteristique.label}}" ng-bind="caracteristique.label"></label>
			</div> 
          </div>
        </div>

        <button class="default text" name="button" type="button" ng-click="nextStape()">Suivant</button>
      </div>

	      	</div>
		</div>
</div>
<style type="text/css">
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
</style>