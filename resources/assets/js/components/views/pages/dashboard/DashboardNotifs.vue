<template>
<div>  
<!--GENERAL (New Messaged Received)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-info">
                <i class="fa fa-envelope-o medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p>You have new message received!</p>
        </div>
    </div>

<!--ACMA (Board Notifs/Activities)-->
    <!--When added as member of a board-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Sam</span> added you to board <span class="highlight">Board Name Here</span></p>
        </div>
    </div>

    <!--When removed from a board-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Sam</span> removed you from the board <span class="highlight">board</span></p>
        </div>
    </div>

    <!--When set the role to 'Scrum Master' (Scrum Board Only)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> set your role to <span class="highlight">Scrum Master</span> in board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When set the role to 'Dev Team' (Scrum Board Only)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> set your role to <span class="highlight">Dev Team</span> in board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When set the role to 'Product Owner' (Scrum Board Only)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> set your role to <span class="highlight">Product Owner</span> in board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When assigned as admin-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> assigned you as an <span class="highlight">Admin</span> of board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When removed from being admin-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> removed you as an <span class="highlight">Admin</span> of board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When another admin updated board's setting-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p>Admin <span class="highlight">_____</span> updated the settings of board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When another admin updated board's setting-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> was added to the board <span class="highlight">_____</span></p>
        </div>
    </div>

    <!--When New Task was Assigned-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-danger">
                <i class="fa fa-task medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p>A new task <span class="highlight">_____</span> has been assigned to you on board <span class="highlight">Board Here</span></p>
        </div>
    </div>


<!--ACMA (Workbook)-->
    <!--When a workbook submitted is reviewed by the client-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-warning">
                <i class="fa fa-star medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p>The workbook <span class="highlight">_____</span> has been reviewed by <span class="highlight">Luljetta's</span></p>
        </div>
    </div>


<!--RegEmp (Board Notifs/Activities)-->
<!--Same as ACMA's Board Notifs-->


<!--Client (Workbook)-->
    <!--When a workbook submitted-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-warning">
                <i class="fa fa-book medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Aya</span> has submitted the workbook <span class="highlight">Workbook Name</span>. Click here to review.</p>
        </div>
    </div>

<!--Client (JO)-->
    <!--When new JO is created-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-warning">
                <i class="fa fa-book medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Aya</span> has created new Job Order <span class="highlight">JO Name</span> for <span class="highlight">Brand Name</span>.</p>
        </div>
    </div>

    <!--When changed the status of a JO-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-warning">
                <i class="fa fa-book medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Aya</span> has changed the status of Job Order <span class="highlight">JO Name</span> to <span class="highlight">Completed / Blocked</span>.</p>
        </div>
    </div>


<!--Client (Board)-->
    <!--When set the role to 'Product Owner' (Scrum Board Only)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">_____</span> set your role to <span class="highlight">Product Owner</span> in board <span class="highlight">_____</span></p>
        </div>
    </div>


<!--Admin (Board)-->
    <!--When set the role to 'Product Owner' (Scrum Board Only)-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-trello medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Sam</span> created new board <span class="highlight">Board Name Here</span></p>
        </div>
    </div>

    <!--When a workbook has been submitted-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-book medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Workbook</span> has been submitted to <span class="highlight">Luljettas</span> for review.</p>
        </div>
    </div>

    <!--When a workbook has been reviewed-->
    <div class="notifdiv">
        <div class="notif-left">
            <div class="notif-icon bg-success">
                <i class="fa fa-book medium-avatar" alt=""></i>
            </div>
        </div>
        <div class="notif-right">
            <p><span class="highlight">Luljettas</span> sumitted the review for workbook <span class="highlight">Workbook Name</span></p>
        </div>
    </div>

    



</div>
</template>
