Vue.component('property-list', {
	props:['properties'],
	template: `
	
	<div class="row g-4">
		<div class="col-lg-4 col-md-6" v-for="(property, index) in properties">
			<div class="rounded overflow-hidden">
				<div class="position-relative overflow-hidden">
					<a href=""><img class="img-fluid" :src="property.titleImageFull" alt="" style="max-height:200px;"></a>
					<div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{property.operationList[0].type}}</div>
					<div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{property.propertyType}}</div>
				</div>
				<div class="p-4 pb-0">
					<h5 class="text-primary mb-3">{{property.operationList[0].formatedAmount}}</h5>
					<a class="d-block h6 mb-2" href="">{{property.title}}</a>
					<p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{property.location}}</p>
				</div>
				<div class="d-flex border-top">
					<small class="flex-fill text-center border-end py-2" v-if="property.constructionSize !== 0"><i class="fa fa-ruler-combined text-primary me-2"></i>{{property.constructionSize}} mt2</small>
					<small class="flex-fill text-center border-end py-2" v-if="property.bedrooms !== null && property.bedrooms !== 0"><i class="fa fa-bed text-primary me-2"></i>{{property.bedrooms}} Cuartos</small>
					<small class="flex-fill text-center py-2" v-if="property.bathrooms !== null"><i class="fa fa-bath text-primary me-2"></i>{{property.bathrooms}} baños</small>
				</div>
			</div>
		</div>
	</div>`
});


const app = new Vue({
	el: '#app',
	data: {
		pagination: null,
		propertyList: [],
	},
	methods:
	{
		getData ()
		{
			let self = this;
			$.ajax({
				url: "/src/property/property.php",
				type: "GET",
				success (result) {
					try {
						const response = JSON.parse(result);
						app.propertyList = response.propertyList;
						app.pagination = response.pagination.nextPage;
						$("#loading").removeClass("d-flex");
						$("#loading").addClass("d-none");
					}
					catch (e) {
						console.log(e);
					}
				},
				error (xhr, ajaxOptions, thrownError) {
					console.log(xhr, ajaxOptions, thrownError)
				}
			});
		},
		getNextPage() {
			let self = this;
			window.onscroll = () => {
			  let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
			  if (bottomOfWindow) {
				if (app.pagination === null) {
					return;
				}
				$("#loading").removeClass("d-none");
				$("#loading").addClass("d-flex");
				$.ajax({
					url: `/src/property/property.php?nextPage=${app.pagination.split("?")[1]}`,
					type: "GET",
					success (result) {
						try {
							const response = JSON.parse(result);
							app.propertyList = app.propertyList.concat(response.propertyList);
							app.pagination = response.pagination.nextPage;
							$("#loading").removeClass("d-flex");
							$("#loading").addClass("d-none");
						}
						catch (e) {
							console.log(e);
						}
					},
					error (xhr, ajaxOptions, thrownError) {
						console.log(xhr, ajaxOptions, thrownError)
					}
				});
			  }
			}
		}
	},
	beforeMount(){
		this.getData();
	},
	mounted (){
		this.getNextPage();
	}
});