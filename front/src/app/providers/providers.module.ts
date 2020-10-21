import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { DemoMaterialModule } from '../demo-material-module';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ProvidersComponent } from './providers.component';
import { ProvidersRoutes } from './providers.routing';
import { MatInputModule } from '@angular/material/input';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import {MatSelectModule} from '@angular/material/select';
import {MatIconModule} from '@angular/material/icon';
import {MatMenuModule} from '@angular/material/menu';
import {MatDialogModule} from '@angular/material/dialog';
import { DialogOverviewExampleDialog } from './customers.component';


@NgModule({
  imports: [
    CommonModule,
    DemoMaterialModule,
    FlexLayoutModule,
    MatInputModule,
    FormsModule,
    MatSelectModule,
    MatIconModule,
    MatMenuModule,
    MatDialogModule,
    ReactiveFormsModule,
    RouterModule.forChild(CustomersRoutes)
  ],
  declarations: [CustomersComponent, DialogOverviewExampleDialog],
  entryComponents: [
    DialogOverviewExampleDialog
  ],
})
export class CustomersModule {}
