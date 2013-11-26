//
//  TableViewController.h
//  vgc
//
//  Created by Sarav Ramaswamy on 11/10/13.
//  Copyright (c) 2013 Simply Hired. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface TableViewController : UITableViewController <UITableViewDataSource> {
}

@property (weak, nonatomic) IBOutlet UITableView *catTableView;
@property (strong, nonatomic) NSArray *itemsArray;

@end
