import { Routes } from '@angular/router';

import { TwilioComponent } from './twilio.component';

export const TwilioRoutes: Routes = [
  {
    path: '',
    component: TwilioComponent,
	data: {
      title: 'Twilio',
      urls: [
        { title: 'Twilio' }
      ]
    }
  }
];
