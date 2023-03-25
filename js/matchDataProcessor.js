function roundInt(val) {
	return Math.round((val + Number.EPSILON) * 100) / 100;
}

function getCannedCommentsDictionary(data) {
	/* Returns a mapping of comment to list of matches */
	var commentLookup = {};
	for (var i = 0; i != data.length; i++) {
		var row = data[i];
		if (row['cannedComments'] === '') {
			continue;
		}
		var cannedSplit = row['cannedComments'].split(',');
		for (var j = 0; j != cannedSplit.length; j++) {
			var comment = cannedSplit[j];
			if (!(comment in commentLookup)) {
				commentLookup[comment] = [];
			}
			commentLookup[comment].push(row['matchNumber']);
		}
	}
	return commentLookup;
}

function getMobilityAuto(row) {
	return row['autoMobility'] === 1;
}

function getEngageTeleop(row) {
	return row['teleopChargeStation'] == 'ENGAGED';
}

function getDockTeleop(row) {
	return row['teleopChargeStation'] == 'DOCKED';
}

function getParkTeleop(row) {
	return row['teleopChargeStation'] == 'COMMUNITY';
}

function getDockAuto(row) {
	return row['autoChargeStation'] == 'DOCKED';
}
function getEngageAuto(row) {
	return row['autoChargeStation'] == 'ENGAGED';
}

function getAutoChargeStationPoints(row){
	var points = 0;
	points += getDockAuto(row) ? 8 : 0;
	points += getEngageAuto(row) ? 12 : 0;
	return points;
}

function getTeleopChargeStationPoints(row){
	var points = 0;
	points += getDockTeleop(row) ? 6 : 0;
	points += getEngageTeleop(row) ? 10 : 0;
	return points;
}

function getTopAuto(row) {
	return row['autoConeLevel3'] + row['autoCubeLevel3'];
}
function getMiddleAuto(row) {
	return row['autoConeLevel2'] + row['autoCubeLevel2'];
}
function getBottomAuto(row) {
	return row['autoConeLevel1'] + row['autoCubeLevel1'];
}

function getTopTeleop(row) {
	return row['teleopConeLevel3'] + row['teleopCubeLevel3'];
}
function getMiddleTeleop(row) {
	return row['teleopConeLevel2'] + row['teleopCubeLevel2'];
}
function getBottomTeleop(row) {
	return row['teleopConeLevel1'] + row['teleopCubeLevel1'];
}

function getCubesAuto(row) {
	return (
		row['autoCubeLevel3'] + row['autoCubeLevel2'] + row['autoCubeLevel1']
	);
}
function getCubesTeleop(row) {
	return (
		row['teleopCubeLevel3'] +
		row['teleopCubeLevel2'] +
		row['teleopCubeLevel1']
	);
}

function getConesAuto(row) {
	return (
		row['autoConeLevel3'] + row['autoConeLevel2'] + row['autoConeLevel1']
	);
}
function getConesTeleop(row) {
	return (
		row['teleopConeLevel3'] +
		row['teleopConeLevel2'] +
		row['teleopConeLevel1']
	);
}

function getPiecesAuto(row) {
	return getConesAuto(row) + getCubesAuto(row);
}
function getPiecesTeleop(row) {
	return getConesTeleop(row) + getCubesTeleop(row);
}

function getMatchPoints(row) {
	var points = 0;
	if (getMobilityAuto(row)) {
		points += 3;
	}
	if (getDockAuto(row)) {
		points += 8;
	}
	if (getEngageAuto(row)) {
		points += 12;
	}
	if (getDockTeleop(row)) {
		points += 6;
	}
	if (getEngageTeleop(row)) {
		points += 10;
	}
	if (getParkTeleop(row)){
		points += 2;
	}
	points += 3 * getBottomAuto(row);
	points += 4 * getMiddleAuto(row);
	points += 6 * getTopAuto(row);
	points += 2 * getBottomTeleop(row);
	points += 3 * getMiddleTeleop(row);
	points += 5 * getTopTeleop(row);
	return points;
}

function getMatchGamePiece(row) {
	return getPiecesAuto(row) + getPiecesTeleop(row);
}
