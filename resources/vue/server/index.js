import http from './http.js'

export function getVersion(data) {
    return http({
        url: '/version',
        method: 'get',
        data
    })
}

export function login(data) {
    return http({
        url: '/auth/login',
        method: 'post',
        data
    })
}

export function getMe(data) {
    return http({
        url: '/auth/me',
        method: 'get',
        data
    })
}
