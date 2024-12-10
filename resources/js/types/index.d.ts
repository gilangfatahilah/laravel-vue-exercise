export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Product {
    id: number;
    name: string;
    price: number;
    price_formatted: string;
    brand: string;
    weight: string;
    category: {
        id: number;
        name: string;
    }
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $page: PageProps & {
            props: {
                auth: {
                    user: User
                }
            }
        }
    }
}