import ability from './ability'

export const canNavigate = to => to.matched.some(route => ability.can('read', route.meta.resource))

export const _ = undefined
