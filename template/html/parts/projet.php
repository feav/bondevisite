<div ng-controller="choiceStep6" class="form-select">	
	<div action="#" method="get" ng-submit="nextStape()">
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Votre projet</h2>	
			<p class="help-text">Veuillez décrire votre projet</p>
			<div  class="valuer-formulaire-step1" >

		        <div class="valuer-formulaire-step4   ng-star-inserted" formgroupname="step4" style="">

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
        <button  type="submit" class="default text" name="button"  ng-click="nextStape()">Suivant</button>
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

<style type="text/css">
@media screen and (max-width: 480px){
	.dropdown-box.center-horizontal {
	    margin: auto;
	}
	form.ng-dirty.ng-valid-parse.ng-invalid.ng-invalid-required {
	    width: inherit;
	}
	#choiceWhere .form-select {
	    width: 100%;
	}
	.inputs-row {
	    flex-direction: column;
	}
	.inputs-row {
	    flex-direction: column;
	    margin-bottom: 7px;
	}
	.inputNumberContainer {
	    margin: 0;
	}
}
</style>
