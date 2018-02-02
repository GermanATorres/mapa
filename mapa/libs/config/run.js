import app from '../app'


app.config(['RestangularProvider', '$interpolateProvider', (RestangularProvider, $interpolateProvider) => {
  RestangularProvider.setBaseUrl('.');
  $interpolateProvider.startSymbol('[[')
  $interpolateProvider.endSymbol(']]')
}])

app.run(function($rootScope) {
  
})

