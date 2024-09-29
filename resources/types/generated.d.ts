declare namespace App.Data {
export type ToastData = {
message: string | null;
type: any | null;
position: any | null;
};
export type UserData = {
id: number;
name: string;
email: string;
};
}
declare namespace App.Data.Category {
export type CategoryData = {
id: number | null;
menuId: number | null;
totalProducts: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
products: any | any | Array<App.Data.Product.ProductData> | null;
menuType: any | App.Data.Menu.MenuTypeData | null;
};
}
declare namespace App.Data.Menu {
export type MenuTypeData = {
id: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
totalCategories: any | any | number;
totalProducts: any | any | number;
categories: any | any | Array<App.Data.Category.CategoryData> | null;
};
}
declare namespace App.Data.Product {
export type ProductData = {
id: number | null;
categoryId: any | number | null;
name: string;
price: string;
image: string | null;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
category: any | App.Data.Category.CategoryData | null;
};
}
