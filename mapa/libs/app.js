import angular from 'angular'
import { controllers, plugins } from './config'


let app = angular.module('projects.labfarmacia.app', [
  'projects.labfarmacia.controllers',
  'projects.plugins.controllers'
])

module.exports = app
