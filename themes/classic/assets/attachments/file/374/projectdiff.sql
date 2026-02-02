select IncomeRecord.ID IncomeRecord_ID
		,IncomeRecordChild.id IncomeRecordChild_id
		,Contribution.ID Contribution_ID
		,contribution.personid contribution_personid
		,IncomeRecord.project_type IncomeRecord_project_type 
		,Contribution.Project_type Contribution_Project_type 
from IncomeRecord inner join IncomeRecordChild on IncomeRecord.ID=IncomeRecordId
inner join Contribution on ContributionID =Contribution.ID
where IncomeRecord.oldID is null
and IncomeRecord.project_type <>Contribution.Project_type 