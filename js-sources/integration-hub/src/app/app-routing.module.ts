import {ApplicationModule, NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {ApplicationListComponent} from "./features/applications/application-list/application-list.component";
import {ApplicationEditComponent} from "./features/applications/application-edit/application-edit.component";
import {LoginComponent} from "@app/features/login/login.component";
import {ClearLayoutComponent} from "@app/layouts/clear-layout/clear-layout.component";
import {ApplicationLayoutComponent} from "@app/layouts/application-layout/application-layout.component";

const routes: Routes = [
    {path: '', redirectTo: '/applications', pathMatch: 'full'},
    {
        path: "", component: ClearLayoutComponent, children: [
            {path: "login", component: LoginComponent},
        ]
    },
    {
        path: "", component: ApplicationLayoutComponent, children: [
            {path: "applications", component: ApplicationListComponent},
            {path: "applications/add", component: ApplicationEditComponent},
            {path: "applications/:id", component: ApplicationEditComponent}
        ]
    }
];


@NgModule({
    exports: [RouterModule],
    imports: [
        RouterModule.forRoot(routes)
    ]
})
export class AppRoutingModule {
}
