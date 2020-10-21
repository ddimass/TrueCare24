import { Component, AfterViewInit } from '@angular/core';
import {PhpRestService} from '../services/php-rest.service';



@Component({
  selector: 'app-twilio',
  templateUrl: './twilio.component.html',
  styleUrls: ['./twilio.component.scss']
})
export class TwilioComponent implements AfterViewInit {
  // Timeline
  twilio_sid = 'SID';
  twilio_token = 'Token';
  constructor(public php: PhpRestService){}
  ngAfterViewInit() {
    
  }
}
