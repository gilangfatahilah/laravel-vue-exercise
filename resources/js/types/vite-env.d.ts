/// <reference types="vite/client" />
/// <reference types="@inertiajs/vue3" />

import { PageProps } from '@inertiajs/core'
import { User } from '.'

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $page: PageProps & {
            props: {
                auth: {
                    user: User
                },
                toast: {
                    message: string
                }
            }
        }
    }
}
