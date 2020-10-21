import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { DemoMaterialModule } from '../demo-material-module';
import { FlexLayoutModule } from '@angular/flex-layout';
import { TwilioComponent } from './twilio.component';
import { TwilioRoutes } from './twilio.routing';
import { MatInputModule } from '@angular/material/input';
import { FormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    DemoMaterialModule,
    FlexLayoutModule,
    MatInputModule,
    FormsModule,
    RouterModule.forChild(TwilioRoutes)
  ],
  declarations: [TwilioComponent]
})
export class TwilioModule {}
