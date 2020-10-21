import { Component, OnInit, AfterViewInit, Inject} from '@angular/core';
import { PhpRestService } from '../services/php-rest.service';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { NONE_TYPE } from '@angular/compiler';

export interface IProviders {
  id: number
  name: string;
  email: string;
  phone: string;
  type: number;
  status_id: number;
}



@Component({
  selector: 'app-providers',
  templateUrl: './providers.component.html',
  styleUrls: ['./providers.component.scss']
})
export class ProvidersComponent implements AfterViewInit {
  // Timeline
  displayedColumns: string[] = ['type', 'name', 'email', 'phone', 'id', 'status', 'actions'];
  dataSource: IProviders[]  = [];

  constructor(public php: PhpRestService, public dialog: MatDialog) {
  }
  call(element: any) {
    console.log(element);
    if (this.php.twilio_sid == 'SID') {
      alert('Set twilio SID in twilio settings page!');
    } else {
      this.php.call(element.phone).subscribe(data => console.log(data));
    }

  }
  openDialog(element: any): void {
    const dialogRef = this.dialog.open(DialogOverviewExampleDialog, {
      width: '250px',
      data: {id: element.id}
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log(result);
    });
  }
  ngAfterViewInit() {
    
    
  }
  ngOnInit() {
    this.php.getData().subscribe(data => {this.dataSource = data['records']});
  }
  updateStatus(value: any, element: IProviders){
    element.status_id = value;

    this.php.updateProvierStatus(element).subscribe(data => {console.log(data)});
  }
}

@Component({
  selector: 'dialog-overview-example-dialog',
  templateUrl: 'feedback.html',
  styleUrls: ['./feedback.scss']
})
export class DialogOverviewExampleDialog implements AfterViewInit {
  hovered_value = 0;
  message = ''
  provider_id: number;
  id: number| null = null;
  selected = 0;
  constructor(
    public dialogRef: MatDialogRef<DialogOverviewExampleDialog>,
    @Inject(MAT_DIALOG_DATA) public data: any, public php: PhpRestService) {
      this.provider_id = data['id'];
      this.php.getFeedback(this.provider_id).subscribe(data => {
        if (data['message'] != 'Not found') {
          this.message = data['message'];
          this.selected = data['value'];
          this.id = data['id'];
          this.hovered_value = data['value'];
        }
      });
    }

  onNoClick(): void {

    this.php.updateFeedback({id: this.id, value: this.selected, message: this.message, provider_id: this.provider_id}).subscribe(data=>{console.log(data)});
    this.dialogRef.close();
  }
  select(num: number) {
    this.selected = num;

  }
  setHover(num: number) {
    if (num == 0){
      if (this.selected == 0) {
        this.hovered_value = 0;
      } else {
        this.hovered_value = this.selected;
      }
    }
    if (num > 0){
      this.hovered_value = num;
    }

  }
  ngAfterViewInit() {
    
  }

}
