<div ng-controller="choiceStep3" class="form-select">	
		<div class="dropdown-box center-horizontal">
			<h2 class="main-title">Type de bien</h2>	
			<p class="help-text">Veuillez choisir le type de bien</p>
			<div  class="valuer-formulaire-step1" >

		        <div  class="valuer-formulaire-step3-boxes">

		          <label  class="type-maison" ng-repeat="posibility in posibilities" ng-click="choiceItem(posibility)" ng-class="posibility.id==choice?'choice':''">
		            <i  class="fas fa-{{posibility.icon}}"></i>
		            <h4  class="" ng-bind="posibility.label"></h4>
		          </label>

		        </div>
				<button class="default text" ng-click="nextStape()">Suivant</button>

	      	</div>
		</div>
</div>
<style type="text/css">
 i.fas{
    font-size: 35px;
    color: #5277a3;
}
.valuer-formulaire-step3-boxes {
    display: flex;
    justify-content: space-between;
    width: 330px;
}
.type-maison.choice{
	    border: 3px solid #5277a3;
}
.type-maison{
	    font-weight: 700;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 150px;
    margin: 0;
    height: 150px;
    border-radius: 10px;
    background: #fff;
    -webkit-box-shadow: 0 7px 13px 1px rgba(0,0,0,.15);
    box-shadow: 0 7px 13px 1px rgba(0,0,0,.15);
    cursor: pointer;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 20px;
    -webkit-transition: .1s ease-in;
    transition: .1s ease-in;
}
.type-maison:hover {
    -webkit-box-shadow: 0 4px 13px 1px rgba(0,0,0,.05);
    box-shadow: 0 4px 13px 1px rgba(0,0,0,.05);
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

	button.default.text {
		margin-top: 45px;
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
</style>


<style type="text/css">
@media screen and (max-width: 480px){
	.dropdown-box.center-horizontal {
	    width: 100%;
	}
	.valuer-formulaire-step1-box {
	    width: 100%;
	}
	h2.item-what-title.ng-binding {
	    font-size: 10pt;
	}
	.item-what {
	    font-size: 8pt;
	}
	.valuer-formulaire-step3-boxes {
	    display: flex;
	    width: 90%;
	    justify-content: space-around;
	}
	label.type-maison.ng-scope {
	    width: 45%;
	}
	#choiceWhere .form-select {
	    width: 100%;
	}

	#choiceWhere .form-select {
	    justify-content: normal;
	        width: 90%;
	}
	.type-maison {
	    max-width: 110px;
	}
	.valuer-formulaire-step3-boxes {
	    width: 100%;
	}
	h4.ng-binding {
	    font-size: 10pt;
	}
	.type-maison {
	    max-width: 110px;
	    padding-bottom: 0;
	}
	label.type-maison.ng-scope {
	    max-width: 110px;
	}
}
</style>