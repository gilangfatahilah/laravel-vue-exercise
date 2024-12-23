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
    description: string;
    category: {
        id: number;
        name: string;
    }
}

interface MetaLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    links: MetaLink[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

export interface ProductResponse {
    data: Product[];
    meta: Meta;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};