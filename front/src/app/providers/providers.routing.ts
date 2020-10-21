import { Routes } from '@angular/router';

import { ProvidersComponent } from './providers.component';

export const ProvidersRoutes: Routes = [
  {
    path: '',
    component: ProvidersComponent,
	data: {
      title: 'Providers',
      urls: [
        { title: 'Providers' }
      ]
    }
  }
];
