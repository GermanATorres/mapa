import angular from 'angular'
import app from './app'

require('./config/run')
require('./controllers')

angular.bootstrap(document, ['projects.labfarmacia.app'])
