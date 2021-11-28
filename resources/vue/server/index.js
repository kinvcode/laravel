import http from './http.js'

export function getVersion (data) {
  return http({
    url: '/version',
    method: 'get',
    data
  })
}
