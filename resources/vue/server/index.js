import http from './http.js'

export function getVersion(data) {
    return http({
        url: '/api/home/version',
        method: 'get',
        data
    })
}

export function login(data) {
    return http({
        url: '/api/home/auth/login',
        method: 'post',
        data
    })
}

export function getMe(data) {
    return http({
        url: '/api/home/auth/me',
        method: 'get',
        data
    })
}
