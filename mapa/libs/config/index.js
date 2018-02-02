import angular from 'angular'
import restangular from 'restangular'
import ngMap from 'ngMap'

module.exports.controllers = angular.module('projects.labfarmacia.controllers', [])
module.exports.plugins = angular.module('projects.plugins.controllers', [
  'restangular',
  'ngMap',
])
