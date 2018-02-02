module.exports = function($scope, $rootScope, NgMap, Restangular) {
  $scope.googleMapsUrl="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhvC3rIiMvEM4JUPAl4fG1xNPRKoRnoTg&libraries=geometry"
  $scope.vm = this;

  let array = window.location.href.split('/');
  $scope.id = parseInt(array[array.length - 1])

  NgMap.getMap().then((map) => {
    $scope.vm = map
    $scope.vm.positions = [];
  });
    $scope.addMarker = (event) => {
    var ll = event.latLng;
    if(ll){
      Restangular.all('/mapas').customPOST({
        id: $scope.id, 
        lat:ll.lat(), 
        lng: ll.lng()
      }, 'create').then((response) => {
        let array = $scope.vm.positions;
        if(array.length == 0){
          $scope.vm.positions.push({ 'lat': response.lat, 'lng': response.lng })
        }else{
          $scope.vm.positions[0] =  {
            'lat': response.lat,
            'lng' : response.lng
          }
        }
        
        /*$scope.item = Object.assign($scope.item, {
          lat: response.data.lat,
          lng: response.data.lng
        })
        $scope.vm.positions[0] = {lat:ll.lat(), lng: ll.lng()}
        toastr.success(response.message, 'Exito!')        */
      }, (error) => {
        toastr.success(error.data.message, 'Error!')
      })
    }
  }
}